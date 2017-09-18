#include<iostream.h>
#include<conio.h>
void main()
{
	int num1, num2, num3, big=0, small=0;
//Code to read 03 numbers.	
	cout<<"Enter 03 Nos. fi find biggest and smallest among them\n";
	cout<<"Enter 1st No. : ";
	cin>>num1;
	cout<<"Enter 2nd No. : ";
	cin>>num2;
	cout<<"Enter 3rd No. : ";
	cin>>num3;
	
//Code to find Bigest no.
	if(num1>num2)
	{
		if(num1>num3)
		{
			big=num1;
		}
		else
			big=num3;		
	}
	else if(num2>num3)
	{
		big=num2;
	}	
	else
		big=num3;

	
//Code to find smallest no.
	
	if(num1<num2)
	{
		if(num1<num3)
		{
			small=num1;
		}
		else
			small=num3;		
	}
	else if(num2<num3)
	{
		small=num2;
	}	
	else
		small=num3;

//Display of Biggest & Smallest no.	
cout<<"\n Among 03 numbers : "<<num1<<","<<num2<<","<<num3<<endl;
cout<<" Biggest is : "<<big;	
cout<<"\n Smallest is : "<<small;
		
getch();		
}