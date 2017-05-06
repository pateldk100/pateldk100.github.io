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



void stud :: update()
{ 	 	fstream finout;
		int rno;

		finout.open("stud_class.dat",ios::binary | ios::in | ios::out);

		cout<<"\n Enter the Roll no. whose Mark to be updated : \n";
		cin>>rno;

		while(!finout.eof())
			{
				finout.read((char*) &s, sizeof(s));

				if(s.rollno==rno)
				{
				  cout<<"Old mark is ["<<s.mark<<"] \n";
				  cout<<"Enter new Mark : ";
				  cin>>s.mark;
				  finout.seekp(finout.tellg() - sizeof(s));
				  finout.write((char*) &s, sizeof(s));
				  break;
            }
			}
		finout.close();
		cout<<"\n Record has been Updated.......successfully....";

}
void main()
{
	s.update();

}