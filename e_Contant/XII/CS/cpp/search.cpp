#include<iostream.h>
#include<fstream.h>
#include<stdio.h>

class stud {
				char name[30];
				int rollno;
				float mark;
				public:
				void enter_data();
				void disp_data();
			  }s;



void stud :: disp_data()
{ 	 	ifstream fin;
		int rno;
		fin.open("stud_class.dat",ios::binary | ios::in);
		cout<<"\n Enter the Roll no. to be searched : \n";
		cin>>rno;

		while(!fin.eof())
			{	fin.read((char*) &s, sizeof(s));
				if(s.rollno==rno)
				{
					cout<<"Nmae : "<<s.name<<endl;
					cout<<"Rollno : "<<s.rollno<<endl;
					cout<<"Mark : "<<s.mark<<endl;
					break;
				}
			}
	fin.close();
}
void main()
{
	s.disp_data();

}