#include<iostream.h>
#include<fstream.h>
#include<stdio.h>
#include<stdlib.h>
#include<conio.h>

class stud {
				char name[30];
				int rollno;
				float mark;
				public:
				void enter_rec();
				void display_all();
				void search_rec();
				void update_rec();
				void delete_rec();
			  }s;

//Insert=====================================================

void stud :: enter_rec()
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

//Display============================================================

void stud :: display_all()
{ 	ifstream fin;
	fin.open("stud_class.dat",ios::binary | ios::in);
	cout<<"Records as follows \n\n" ;
	while(!fin.eof())
		{fin.read((char*) &s, sizeof(s));
		 cout<<"Nmae : "<<s.name<<endl;
		 cout<<"Rollno : "<<s.rollno<<endl;
		 cout<<"Mark : "<<s.mark<<endl;
		 cout<<endl;
		}
	fin.close();
}

//Search============================================================

void stud :: search_rec()
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

//Update ============================================================

void stud :: update_rec()
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

//Delete ===========================================================

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

int main_menu()
{  clrscr();
	int choice;
	cout<<"\n\n\n";
	cout<<"\n              +++++++++++++++++++++++++++++++++++++++";
	cout<<"\n              |           M A I N   M E N U         |";
	cout<<"\n              |        -----------------------      |";
	cout<<"\n              |  1.    Enter Record                 |";
	cout<<"\n              |  2.    Display All Records          |";
	cout<<"\n              |  3.    Search a Record              |";
	cout<<"\n              |  4.    Modify Record                |";
	cout<<"\n              |  5.    Delete Record                |";
	cout<<"\n              |                                     |";
	cout<<"\n              | => Enter your Choice :              |";
	cout<<"\n              |                                     |";
	cout<<"\n              ++++++++++++++++++++++++++++++++++++++";
	gotoxy(40,14);
	cin>>choice;
   return choice;
}

void main()
{
		int ch;
		do
		{
			switch(ch=main_menu())
			{
				case 0:  {  clrscr();
								cout<<"\n\nThanks........bye...";
								exit(0);
								break;
							}
				case 1:  { 	clrscr();
								s.enter_rec();
								break;
							}
				case 2:  { 	clrscr();
								s.display_all();
								break;
							}
				case 3:  { 	clrscr();
								s.search_rec();
								break;
							}
				case 4:  { 	clrscr();
								s.update_rec();
								break;
							}
				case 6:  { 	clrscr();
								s.delete_rec();
								break;
							}
				default:	{ 	clrscr();
								cout<<"Sorry! Wrong choice.....";
							}
			}
         cout<<"press any key to continue........";
		  getch();
		}while(ch!=0);

}
	

