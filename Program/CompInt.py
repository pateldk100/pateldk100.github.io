def CompoundInterest():
    P=int(input("Enter Principal amount : "))
    R=float(input("Enter Rate of Interest (%) : "))
    T=float(input("Enter Time of deposit : "))
    A=P*pow((1+R/100),T)
    A=round(A,2)
    CI=round(A-P,0)
    print("Interest is : ",CI,"\nTotal Amount paid : ",A)
#-------------------------------------------------
CompoundInterest()