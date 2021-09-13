create table customer (cid int primary key, first_name text, last_name text, gender text, email text, contact bigint, current_bal int);

insert into customer values(1,'rohini','som','female','monin.gour@hotmail.com',1703634272 ,4000);

insert into customer values(2,'labeen','balasubramanian','male','akalita@jaggi.in',9823595162,8000);

insert into customer values(3,'nishtha','deshmukh','female','ybera@rediffmail.com',5978376109,5000);

insert into customer values(4,'gulab', 'soni','female','piyengar@narula.com',6498013001,9000);

insert into customer values(5,'rakhi', 'shukla','female','gmanne@comar.net',8337268793,3000);

insert into customer values(6,'manish', 'singh','male','balay.anshu@dugar.com',4659601420,5000);

insert into customer values(7,'gulzar','jacob','male','jayaraman.parvez@hotmail.com',3958925632,5000);

insert into customer values(8,'sona','varughese','female','jawahar69@johal.com',1046264347,7000);

insert into customer values(9,'aditi', 'mukhopadhyay','female','kabra.subhash@hotmail.com',7697428744,8000);

insert into customer values(10,'gulzar', 'bhatia','male','hemendra75@yahoo.co.in',6388573773,1000);

create table transfer (tid int primary key, amount int, sender int references customer(cid), receiver int references customer(cid) on delete cascade );