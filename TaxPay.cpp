/*Program to pay the income tax as per following slab :
  Income (Rs.)			Tax (Rs.)
  1 	  - 250000		0%
  250001  - 500000		10%
  500001  - 1000000		20%
  1000001  - above		30%
*/

#include<iostream.h>
#include<conio.h>
void main()
{
	clrscr();
	long double income=1, tax=0;
		
	cout<<"Enter ur Annual Income : ";
	cin>>income;
	
		if(income>1000000)
			{
				tax=tax + 250000 * (10.0/100);	
				tax=tax + 500000 * (20.0/100);	
				tax=tax + (income-1000000) * (30.0/100);
			  
			}
		else if(income>500000)
			{
				tax=tax + 250000 * (10.0/100);	
				tax=tax + ((income-500000) * (20.0/100));
			  
			}
		
		else if(income>250000)
			{
				tax=tax + (income-250000) * (10.0/100);
			  
			}
		
		else
			tax=0;
cout<<"Tax : " <<tax;	
getch();

}

  