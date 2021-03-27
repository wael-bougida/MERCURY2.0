"""
To run the code, you need to check for the packages:
    Need to install sshpass on Linux if you do not have it 

And run these commands if you do not have any of the library
    pip3 install apache_log_parser
    pip3 install pandas
    pip3 install matplotlib

"""
import os
import apache_log_parser
import getpass
import pandas as pd
import matplotlib.pyplot as plt
from matplotlib.ticker import MaxNLocator
import numpy as np
import matplotlib.dates as mdates
from collections import Counter
from datetime import datetime
from matplotlib.backends.backend_pdf import PdfPages

def clamv_access():
    """
    This function helps go to clamv from desktop and into folder apache 
    download the files (access_log and ) to local machine
    """
    uname = input("Clamv username = ")
    passwd = getpass.getpass("Password = ")
    passwd = str(passwd)
    #Download the log files
    st1 = 'sshpass -p '+passwd+' scp '+uname + \
        '@clabsql.clamv.jacobs-university.de:/../../var/log/apache2/access_log ./'
    os.system(st1)
    #Download the error files
    st1 = 'sshpass -p '+passwd+' scp '+uname + \
        '@clabsql.clamv.jacobs-university.de:/../../var/log/apache2/error_log ./'
    os.system(st1)

def page_log(log, page):
    ip_address_list = []
    date_list = []
    browser_list = []

    for x in log:
        if((x['request_url']) == page):
            ip_address_list.append(x['remote_host'])
            date_list.append(x['time_received_isoformat'])
            browser_list.append(x['request_header_user_agent__browser__family'])
    
    return (ip_address_list, date_list, browser_list)



def timeline_plot(name, pdf, page, ip_address_list, date_list, browser_list):
    dates = [datetime.strptime(d[:10], "%Y-%m-%d") for d in date_list]
    
    # The levels array here acts like a counting function!
    levels = []
    levels.append(1)
    for i in range(1, len(dates)):
        if dates[i] == dates[i-1]:
            levels.append(levels[i-1]+1)
        else:
            levels.append(1)


    # Create figure and plot a stem plot with the date
    fig, ax = plt.subplots(figsize=(10, 4))
    
    markerline, stemline, baseline = ax.stem(dates, levels,
                                         linefmt="C3-", basefmt="k-",
                                         use_line_collection=True)

    plt.setp(markerline, mec="k", mfc="w", zorder=3)
    # The vertical stems. Red for error, Green for access
    if(name=="Access"):
        ax.vlines(dates, 0, levels, color="tab:green")
    else:
        ax.vlines(dates, 0, levels, color="tab:red")  
    ax.plot(dates, np.zeros_like(dates), "-o",
            color="k", markerfacecolor="w")  # Baseline and markers on it.

    # annotate lines
    for d, l, i, b in zip(dates, levels, ip_address_list, browser_list):
        ax.annotate(" "+i+" - " +b, xy=(d, l), fontsize='small')

    # format xaxis with 1 day intervals
    ax.xaxis.set_major_locator(mdates.DayLocator(interval=1))
    ax.get_xaxis().set_major_formatter(mdates.DateFormatter("%d %m %Y"))
    plt.setp(ax.get_xticklabels(), rotation=30, ha="right")

    #format yaxis to display only integers
    ax.yaxis.set_major_locator(MaxNLocator(integer=True))

    # remove spines
    for spine in ["left", "top", "right"]:
        ax.spines[spine].set_visible(False)

    #Label and title
    ax.set(xlabel='Day', ylabel='Number of access',
        title= name + " log of page: " + page)
    plt.tight_layout()

    pdf.savefig()
    plt.close()
    

def summary_plot(pdf, cnt):
    c = dict(cnt)
    count = c.values()
    plt.rcdefaults()
    fig, ax = plt.subplots(figsize=(10, 4))
    y_pos = np.arange(len(c))
    ax.barh(y_pos, count, align='center')
    ax.set_yticks(y_pos)
    ax.set_yticklabels(c)
    ax.invert_yaxis()  # labels read top-to-bottom
    ax.set_xlabel('Number of access')
    ax.set_title('Summary of Access Log')
    plt.tight_layout()
    pdf.savefig()

def main():

    clamv_access()
    file1 = open("access_log", "r")
    line_parser = apache_log_parser.make_parser(
        "%h %l %u %t \"%r\" %>s %b \"%{Referer}i\" \"%{User-Agent}i\"")

    logs = []
    access_pages = []
    errors = []
    error_pages = []
    log_line = {}
    cnt = Counter()

    for line in file1:
        # find returns -1 if it does not find the searched word in the line
        # since we only need the data for the main pages not css and images we search for the line that only has the main pages
        if (line.find('~tpham') != -1 and line.find('css') == -1 and line.find('js') == -1 and line.find('img') == -1 and line.find('title') == -1 and line.find('id') == -1):
            log_line = line_parser(line)

            # all status > 400 are error
            if(int(log_line['status']) >= 400):  
                # all the errors are stored in a separate list
                errors.append(log_line)

            logs.append(log_line)

    for x in logs:
        if (x['request_url'] not in access_pages):
            access_pages.append(x['request_url'])

    for x in errors:
        if (x['request_url'] not in error_pages):
            error_pages.append(x['request_url'])

    with PdfPages("Log_statistics.pdf") as pdf:
        for page in access_pages:
            ip_address_list, date_list, browser_list = page_log(logs, page)
            timeline_plot("Access",pdf, page, ip_address_list, date_list, browser_list)
            cnt[page] = len(ip_address_list)
        
        summary_plot(pdf, cnt)
        for page in error_pages:
            ip_address_list, date_list, browser_list = page_log(logs, page)
            timeline_plot("Error", pdf, page, ip_address_list, date_list, browser_list)
            
main()
