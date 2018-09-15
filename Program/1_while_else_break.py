myNum = 5
myVar = 1
while myVar <= 10 :
     if myVar == myNum :
            print ("Breaking out of the loop")
            break
     print("This number = " + str(myVar))
     print (chr(8377))
     myVar += 1
else:
    print (chr(8377))
