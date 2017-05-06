#include<iostream.h>
#include<fstream.h>
#include<stdio.h>

void file_write()
{  ofstream fout;
	fout.open("stud.dat",ios::out);
	char yn='y';
	char name[30];
	int rollno;
	float mark;
	while(yn=='y')
				{  cout<<"Enter ur Name : ";
					gets(name);
					cout<<"Enter ur Roll no. : ";
					cin>>rollno;
					cout<<"Enter ur Mark : ";
					cin>>mark;
					fout<<name<<'\t'<<rollno<<'\t'<<mark<<'\n';
					cout<<"Want u enter more record (y/n) : ";
					cin>>yn;
				}
	fout.close();
}

void disp()
{  char ch;
	ifstream fin;
	fin.open("stud.dat",ios::in);
	while(fin.get(ch))
		{
		 cout<<ch;
		}
	fin.close();
}
void main()
{
 file_write();
 cout<<"\n All records are \n";
 disp();

}
