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
				void disp_data1();
			  }s;

void stud :: enter_data()
{  ofstream fout;
	fout.open("stud_class.dat",ios::binary |ios::app);         
	char yn='y';
	while(yn=='y')
				{  cout<<"Enter ur Name : ";
					gets(s.name);
					cout<<"Enter ur Roll no. : ";
					cin>>s.rollno;
					cout<<"Enter ur Mark : ";
					cin>>s.mark;
					fout.write((char*) &s, sizeof(s));
					cout<<"Want u enter more record (y/n) : ";
					cin>>yn;
				}
	fout.close();
}


void stud :: disp_data()
{ 	ifstream fin;
	fin.open("stud_class.dat",ios::binary | ios::in);
	while(!fin.eof())
		{fin.read((char*) &s, sizeof(s));
		 cout<<"Nmae : "<<s.name<<endl;
		 cout<<"Rollno : "<<s.rollno<<endl;
		 cout<<"Mark : "<<s.mark<<endl;
		 cout<<endl;
		}
	fin.close();
}
void main()
{ 
	s.enter_data();
	cout<<"\n All records are \n";
	s.disp_data();

}
