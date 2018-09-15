for a in range(256):
    if a%5==0:
        print()
        print("-"*80)
        print (a,"=",chr(a),end="\t|\t")
    else:
        print (a,"=",chr(a),end="\t|\t")
    
