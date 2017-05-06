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
{ 	ifstream fin;
	long recset;
	int recno;
   fin.open("stud_class.dat",ios::binary | ios::in);
	cout<<"\n Enter the record no. to be searched : \n";
	cin>>recno;
		 recset=((recno-1)*sizeof(s));
		 fin.seekg(recset,ios::beg);

		 fin.read((char*) &s, sizeof(s));
				cout<<"Nmae : "<<s.name<<endl;
				cout<<"Rollno : "<<s.rollno<<endl;
				cout<<"Mark : "<<s.mark<<endl;

	fin.close();
}
void main()
{

	s.disp_data();

}