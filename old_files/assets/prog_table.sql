create table if not exists programmes(
id int primary key not null auto_increment,
programme varchar(20),
prog_type varchar(30),
level varchar(10)
);

insert into programmes (programme, prog_type, level)
values('PRE-NCE', 'PRE_NCE', 'PRE-NCE'),
('NCE', 'NCE REGULAR', 'NCE 1'),
('NCE', 'NCE REGULAR', 'NCE 2'),
('NCE', 'NCE REGULAR', 'NCE 3'),
('NCE', 'NCE SANDWICH', 'NCE 1'),
('NCE', 'NCE SANDWICH', 'NCE 2'),
('NCE', 'NCE SANDWICH', 'NCE 3'),
('NCE', 'NCE SANDWICH', 'NCE 4'),
('DEGREE', 'DEGREE REGULAR', 'DEGREE 1'),
('DEGREE', 'DEGREE REGULAR', 'DEGREE 2'),
('DEGREE', 'DEGREE REGULAR', 'DEGREE 3'),
('DEGREE', 'DEGREE REGULAR', 'DEGREE 4'),
('DEGREE', 'DEGREE SANDWICH', 'DEGREE 1'),
('DEGREE', 'DEGREE SANDWICH', 'DEGREE 2'),
('DEGREE', 'DEGREE SANDWICH', 'DEGREE 3'),
('DEGREE', 'DEGREE SANDWICH', 'DEGREE 4'),
('DEGREE', 'DEGREE SANDWICH', 'DEGREE 5')
