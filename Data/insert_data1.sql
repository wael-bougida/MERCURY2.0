
insert into Colleges(cid, name, address) values (345, 'Krupp', 'College Ring 4');
insert into Colleges(cid, name, address) values (346, 'Nordmetall', 'College Ring 3');
insert into Colleges(cid, name, address) values (567, 'Mercator', 'College Ring 2');
insert into Colleges(cid, name, address) values (987, 'College III', 'College Ring 1');


insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(2345, '345A', 3, '345TR', 0, 345);
insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(2346, '345B', 3, '345TO', 0, 345);
insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(1230, '231', 2, '231DF', 1, 346);
insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(3212, '189', 1, '189DS', 0, 346);
insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(1234, '397', 3, '397WR', 1, 567);
insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(1235, '256', 2, '256FT', 0, 987);
insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(1236, '194A', 1, '194SA', 1, 345);
insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(1237, '194B', 1, '194SB', 0, 345);
insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(1238, '213A', 2, '213AC', 1, 567);
insert into Rooms(rid, rnumber, floor, mailbox, availability, cid) values(1239, '213B', 2, '213AD', 0, 567);

 
insert into Double_rooms(rid, position) values (2345,0);
insert into Double_rooms(rid, position) values (2346,1);
insert into Double_rooms(rid, position) values (1234,0);
insert into Double_rooms(rid, position) values (1235,1);
insert into Double_rooms(rid, position) values (1238,0);
insert into Double_rooms(rid, position) values (1239,1);


insert into Students(sid, name, mat_num, birthday, rsid, rid) values (1034, 'Nurgun Rafizade', '35674', '24102001', NULL, 2346);
insert into Students(sid, name, mat_num, birthday, rsid, rid) values (2356, 'Aoge Bo', '24585', '12041999', NULL, 1230);
insert into Students(sid, name, mat_num, birthday, rsid, rid) values (4347, 'Jenni Lo', '33436', '12042001', NULL, 1235);
insert into Students(sid, name, mat_num, birthday, rsid, rid) values (1053, 'Wail Bougida', '23454', '12092000', NULL, 1234);
insert into Students(sid, name, mat_num, birthday, rsid, rid) values (1035, 'Tuan Pham', '34567', '30082001', 1034, 2346);
insert into Students(sid, name, mat_num, birthday, rsid, rid) values (1093, 'John Doe', '34525', '25081998', NULL, 1236);
insert into Students(sid, name, mat_num, birthday, rsid, rid) values (3456, 'Jeng Lu', '33145', '12041997', NULL, 1239);
insert into Students(sid, name, mat_num, birthday, rsid, rid) values (2345, 'Sergey Lav', '43456', '15072001', NULL, 3212);
insert into Students(sid, name, mat_num, birthday, rsid, rid) values (1059, 'Nayan Pradhan', '23384', '30032002', 2356, 1230);
insert into Students(sid, name, mat_num, birthday, rsid, rid) values (1563, 'Jane Doe', '36536', '24082000', 4347, 1235);


insert into Students_with_special_need(sickness, special_need, sid) values ('Obesity', 'Bigger room', 1053);
insert into Students_with_special_need(sickness, special_need, sid) values ('Too Tall', 'Bigger Bed', 1093);
insert into Students_with_special_need(sickness, special_need, sid) values ('Asthma', 'Bigger windows', 2345);


insert into Managers(mgid, name, age, contact_num, cid) values (1234, 'Laura', 35, '12345678', 345);
insert into Managers(mgid, name, age, contact_num, cid) values (3245, 'Lynn', 40, '34567812', 345);
insert into Managers(mgid, name, age, contact_num, cid) values (5778, 'John', 43, '12834561', 567);
insert into Managers(mgid, name, age, contact_num, cid) values (9836, 'Jane', 42, '22233344', 987);
insert into Managers(mgid, name, age, contact_num, cid) values (5432, 'William', 38, '23133449',987);
insert into Managers(mgid, name, age, contact_num, cid) values (3468, 'Qestra', 37, '98733456', 346);
insert into Managers(mgid, name, age, contact_num, cid) values (3981, 'Qamhia', 29, '23456998', 346);


insert into RM(office_hour, mgid) values('10 to 12', 1234);
insert into RM(office_hour, mgid) values('10 to 14', 5778);
insert into RM(office_hour, mgid) values('14 to 18', 9836);
insert into RM(office_hour, mgid) values('10 to 12', 3468);

insert into RA(availability, mgid) values(0, 3245);
insert into RA(availability, mgid) values(1, 5432);
insert into RA(availability, mgid) values(1, 3981);


