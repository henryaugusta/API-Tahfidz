
#Student
0121348385 Kelompok ID 1     mentor 088223738700
0125318219  Kelompok ID 2    mentor 085386555855
bismillah

#mentor
085342043006  SYAMSIDAR 3B dan 4A
Wahdah Islamiyah




#get group_info , 
@param GET/POST (student_id or group_id ) in String
{
    "info": "Berhasil Fetch Data Kelompok",
    "http_code": 200,
    "response_code": 1,
    "message": "Berhasil Fetch Data Kelompok",
    "size": 15,
    "group": [
        {
            "student_id": "1",
            "name": "A. Adibah Ibtisam Abbas",
            "nisn": "1202184264",
            "student_contact": "081241844492",
            "mentor_id": "1",
            "group_id": "10",
            "group_name": "Ibnu Abbas",
            "mentor_name": "Ali Akbar",
            "query": "SELECT * FROM group_data_for_student where mentor_id='1'",
            "mentor_contact": "088223738709"
        },
    ]
}