import sqlite3
conn = sqlite3.connect('Source.sqlite3')

cur = conn.cursor()
cur.execute("create table Manager(name text,password text)")
cur.execute("create table Deal(name text,config text,up text)")

conn.commit()
conn.close()