import sqlite3

conn = sqlite3.connect('Source.sqlite3')

cur = conn.cursor()

cur.execute("insert into Deal Values('方块人整合包','包含了植物魔法mod','Terrium')")


cur.execute("select * from Deal")  #对T_fish表执行数据查找命令
for Deal_row in cur.fetchall():      #以一条记录为元组单位返回结果给row
     print(Deal_row)

cur.execute("select * from Manager")  #对T_fish表执行数据查找命令
for Manager_row in cur.fetchall():      #以一条记录为元组单位返回结果给row
     print(Manager_row)


conn.commit()
conn.close()