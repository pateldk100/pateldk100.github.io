mark=int(input("Enter your total Marks out of 100 : "))

if mark>=75 :
    grade='A'
    result="Excellent"
    
elif 50<=mark<75 :
    grade='B'
    result="Very Good"

elif 33<=mark<50 :
    grade='C'
    result="Good"

else:
    grade='D'
    result="Needs Improvement"

print("Your Grade is : ",grade,"[",result,"]")
