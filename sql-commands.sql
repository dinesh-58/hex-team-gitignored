-- this is only for reference 
/* creating new database file
touch recycle.db
*/

-- run the rest of these SQL commands in SQLite CLI 
create table users(
    userId integer primary key autoincrement,
    fName text not null check(length(fName) <= 40),
    userType text not null check(userType = 'normal' OR userType ='operator'),
    email text not null check(length(email) <= 40),
    password text not null check(length(password) >= 8 AND length(password) <= 14),
    rewardPoints integer not null default 100 check(rewardPoints >= 0)
)

-- check if foreign key constraint is enabled 
PRAGMA foreign_keys;   
-- if this returns 0, run the following 
PRAGMA foreign_keys = ON;

create table logs(
    logId integer primary key autoincrement,
    recycledDate text not null default CURRENT_DATE check(
        length(recycledDate) <= 10
        AND DATE(recycledDate, '+0 days') IS recycledDate
    ), -- checking that date is in proper format
    userId integer not null,
    recycleCategoryId text not null,
    description text check(length(description) <= 240),
    foreign key (userId) references users(userId),
    foreign key (recycleCategoryId) references recycleCategory(categoryId)
)

create table recycleCategory(
    categoryId integer primary key autoincrement,
    categoryName text not null check(length(categoryName) <= 40)
)

insert into `recycleCategory`(`categoryName`) values
('decomposable'),
('paper'),
('cloth'),
('electronics'),
('plastic'),
('metal'),
('wood'),
('glass'),
('miscellaneous')

