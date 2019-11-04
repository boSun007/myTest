#Read file
f = open("demofile.txt", "r")
#print(f.read())
#print(f.read(25))
#print(f.readline())

#print(f.readline())
#for x in f:
#  print(x)
#f.close()

#write(append) file
nf = open("demofile2.txt","a")
nf.write("now the file has more content!")
for x in f:
  nf.write(x)
nf.close()

df = open("demofile2.txt","r")
print(df.read())
newfile = open("demofile3.txt","x")

#remove file
import os
os.remove("demofile3.txt")

#check if file exists

if os.path.exists("demofile3.txt"):
  os.remove("demofile3.txt")
else:
  print("the File does not exist")
  
#delete folder

os.mkdir("folderName")
os.rmdir("folderName")
os.mkdir("thisIsMyFolder")
