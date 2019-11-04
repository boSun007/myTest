import pyodbc
conn = pyodbc.connect('DRIVER={ODBC Driver 17 for SQL Server};'
#conn = pyodbc.connect('DRIVER={/opt/microsoft/msodbcsql17/lib64/libmsodbcsql-17.4.so.2.1};'
                      'Server=192.168.10.171;'
                      'UID=Dev;'
                      'PWD=D3v;'
                      'Database=Serenity;'
                      'Trusted_connection=yes;')

cursor = conn.cursor()
cursor.execute('select * from booking order by BookingID desc')

for row in cursor:
  print(row)
