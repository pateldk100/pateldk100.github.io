#include<iostream.h>
#include<conio.h>
#include<string.h>
#include<stdio.h>
char *UserID={"dinesh"}, *password={"patel"};
int chkPassword()
{
	int x = 8;
	int y = 23;
	int p=0;
	char *pass, *uid;
	gotoxy(y,x);
	cout<<"+-------------------------+";
	gotoxy(y,x+1);
	cout<<"| User Name :             | ";
	gotoxy(y,x+2);
	cout<<"| Password  :             | ";
	gotoxy(y,x+3);
	cout<<"+-------------------------+";
	gotoxy(y+14,x+1);
	gets(uid);
	gotoxy(y+14,x+2);
	while((pass[p]=getch())!=char(13))
	{
		cout<<"*";
		p++;
	}
	for (int i=0; UserID[i]!='\0';i++)
	{
		if(uid[i]!=UserID[i])
			return 0;
	}
	for (int j=0; password[j]!='\0';j++)
	{
		if(pass[j]!=password[j])
			return 0;
	}
	return 1;
}

void main()
	{	
		int ans=chkPassword();
		if(ans==1)
		cout<<"\nOK.....";
		else
			cout<<"\nWrong";
		getch();
	}
