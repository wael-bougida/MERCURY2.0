-- 1. All the students ordered by name
SELECT S.sid,
    S.name,
    S.mat_num
FROM Students S
ORDER BY S.name;
-- 2. Left double room in floor that has more than 2 rooms
SELECT R.rid,
    D.position,
    R.floor
FROM Rooms R
    INNER JOIN Double_rooms D ON D.rid = R.rid
WHERE R.floor IN (
        SELECT R.floor
        FROM Rooms R
        GROUP BY R.floor
        HAVING COUNT(R.rid) > 1
    )
    AND D.position = 0;
-- 3. Count the number of Managers in each college (Group by and Join)
SELECT M.cid,
    COUNT(M.mgid) AS managers_count
FROM Managers M
    INNER JOIN Colleges C ON M.cid = C.cid
GROUP BY M.cid;
-- 4. Students with their room chosen (Join)
SELECT S.sid,
    S.name,
    S.mat_num,
    R.rid,
    R.floor
FROM Students S
    INNER JOIN Rooms R ON S.rid = R.rid;
-- 5. Students with double room
SELECT S.sid,
    S.name,
    S.mat_num
FROM Students S
    INNER JOIN Double_rooms D ON S.rid = D.rid;
-- 6. RA that manages college Krupp
SELECT C.cid,
    C.name,
    M.mgid,
    M.name
FROM Managers M
    INNER JOIN RA ON RA.mgid = M.mgid
    INNER JOIN Colleges C ON C.name = 'Krupp'
    AND C.cid = M.cid;
-- 7. Find the mailbox of student room who lives in floor 2, 3
SELECT S.sid,
    S.name,
    R.floor,
    R.mailbox
From Rooms R
    INNER JOIN Students S ON R.rid = S.rid
WHERE R.floor IN (2, 3);
-- 8. Count students in their colleges
SELECT C.name,
    R.rnumber,
    COUNT(S.sid) AS students_num
FROM Rooms R
    INNER JOIN Students S ON S.rid = R.rid
    INNER JOIN Colleges C ON R.cid = C.cid
GROUP BY R.cid;
-- 9. Students with special needs who live on floor 2 
SELECT S.sid,
    S.name,
    Sw.sickness
FROM Students S
    INNER JOIN Students_with_special_need Sw ON Sw.sid = S.sid
    INNER JOIN Rooms R ON R.rid = S.rid
WHERE R.floor = 2;
-- 10. The floor has more than 2 rooms
SELECT R.floor
FROM Rooms R
GROUP BY R.floor
HAVING COUNT(*) > 3;
-- 11. Count the number of available rooms (Aggregate) 
SELECT COUNT(R.availability)
FROM Rooms R
WHERE R.availability = 1;
    
-- 12. All colleges
SELECT *
FROM Colleges C;

-- 13. Students who live in a specific (3) room
SELECT S.sid,
    S.name,
    S.mat_num
FROM Students S
    INNER JOIN Rooms R ON S.rid = D.rid AND R.floor = 3;


-- 14. All available room in a college
SELECT *
FROM Rooms R
INNER JOIN Colleges C ON C.cid = R.cid AND C.name = 'Krupp' 
WHERE R.availability = 1;