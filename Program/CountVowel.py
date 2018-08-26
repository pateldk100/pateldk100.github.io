line=input("Enter a Line here to count Words & Vowels : ")
cntVowl=0
cntWrd=1
for n in line:
    if str.upper(n)=='A' or str.upper(n)=='E' or str.upper(n)=='I' or str.upper(n)=='O' or str.upper(n)=='U' :
        cntVowl+=1
    if n==' ':
        cntWrd+=1

print("No. of Word is/are : ",cntWrd)
print("No. of Vbwel is/are : ",cntVowl)
        
