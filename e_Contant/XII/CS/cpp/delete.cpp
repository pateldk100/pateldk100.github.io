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
				void update();
				void delete_rec();
			  }s;



void stud :: delete_rec()
{ 	 	ifstream fin;
		ofstream fout;
		int rno;

		fin.open("stud_class.dat",ios::binary | ios::in );
		fout.open("temp.dat",ios::binary | ios::out);

		cout<<"\n Enter the Roll no. to be deleted : \n";
		cin>>rno;

		while(!fin.eof())
			{
				fin.read((char*) &s, sizeof(s));

				if(s.rollno!=rno)
					fout.write((char*) &s, sizeof(s));
			}
      fin.close();
		fout.close();

		remove("stud_class.dat");
		rename("temp.dat","stud_class.dat");
		cout<<"\n Record has been deleted.......successfully....";

}
void main()
{
	s.delete_rec();

}