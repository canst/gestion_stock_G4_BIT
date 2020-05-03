/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  5/2/2020 12:26:14 PM                     */
/*==============================================================*/


drop table if exists CASHBOX;

drop table if exists CLIENTS;

drop table if exists DELIVERIES;

drop table if exists ORDERS;

drop table if exists PRODUCTS;

drop table if exists SUPPLIERS;

drop table if exists SUPPLY;

drop table if exists TYPE;

drop table if exists USERS;

drop table if exists WITHDRAWALS;

/*==============================================================*/
/* Table : CASHBOX                                              */
/*==============================================================*/
create table CASHBOX
(
   ID_CASHBOX           int not null AUTO_INCREMENT,
   ID_USER              int not null,
   primary key (ID_CASHBOX)
)ENGINE=InnoDB;

/*==============================================================*/
/* Table : CLIENTS                                              */
/*==============================================================*/
create table CLIENTS
(
   ID_CLIENT            int not null AUTO_INCREMENT,
   TYPE                 varchar(20),
   NAME                 varchar(20),
   LASTNAME             varchar(20),
   ATTRIBUT_21          varchar(20),
   CONTACTS             varchar(25),
   primary key (ID_CLIENT)
)ENGINE=InnoDB;

/*==============================================================*/
/* Table : DELIVERIES                                           */
/*==============================================================*/
create table DELIVERIES
(
   ID_PRODUCT           int not null,
   ID_SUPPLIER          int not null,
   ID_DELIVERY          int not null AUTO_INCREMENT,
   PRODUCT_NAME         varchar(20),
   TYPE                 varchar(20),
   QUANTITY             decimal,
   PRICE                decimal,
   ID_SUPPLY            int,
   primary key (ID_DELIVERY)
)ENGINE=InnoDB;

/*==============================================================*/
/* Table : ORDERS                                               */
/*==============================================================*/
create table ORDERS
(
   ID_CASHBOX           int not null,
   ID_PRODUCT           int not null,
   ID_CLIENT            int not null,
   ID_COMMANDE          int not null AUTO_INCREMENT,
   DATE                 timestamp,
   PAYMENT_TYPE         varchar(20),
   QUANTITY             decimal,
   PAID                 decimal,
   primary key (ID_COMMANDE)
)ENGINE=InnoDB;

/*==============================================================*/
/* Table : PRODUCTS                                             */
/*==============================================================*/
create table PRODUCTS
(
   ID_PRODUCT           int not null AUTO_INCREMENT,
   ID_TYPE              int not null,
   PRODUCT_NAME         varchar(20),
   FORMAT               varchar(20),
   PRICE                decimal,
   REDUCTION_RATE       decimal,
   EXPIRATION           date,
   QUANTITY             decimal,
   primary key (ID_PRODUCT)
)ENGINE=InnoDB;

/*==============================================================*/
/* Table : SUPPLIERS                                            */
/*==============================================================*/
create table SUPPLIERS
(
   ID_SUPPLIER          int not null AUTO_INCREMENT,
   NAME                 varchar(20),
   CONTACTS             varchar(25),
   EMAIL                varchar(20),
   TYPE                 varchar(20),
   primary key (ID_SUPPLIER)
)ENGINE=InnoDB;

/*==============================================================*/
/* Table : SUPPLY                                               */
/*==============================================================*/
create table SUPPLY
(
   ID_USER              int not null,
   ID_SUPPLIER          int not null,
   ID_SUPPLY            int not null AUTO_INCREMENT,
   PRODUCT_NAME         varchar(20),
   FORMAT               varchar(20),
   QUANITY              decimal,
   DATE                 timestamp,
   primary key (ID_SUPPLY)
)ENGINE=InnoDB;

/*==============================================================*/
/* Table : TYPE                                                 */
/*==============================================================*/
create table TYPE
(
   ID_TYPE              int not null AUTO_INCREMENT,
   NAME                 varchar(20),
   primary key (ID_TYPE)
)ENGINE=InnoDB;

/*==============================================================*/
/* Table : USERS                                                */
/*==============================================================*/
create table USERS
(
   ID_USER              int not null AUTO_INCREMENT,
   NAME                 varchar(20),
   FIRSTNAME            varchar(20),
   CNIB                 varchar(8),
   GENDER               char(1),
   USERNAME             varchar(8),
   TYPE                 varchar(20),
   CONTACTS             varchar(25),
   primary key (ID_USER)
)ENGINE=InnoDB;

/*==============================================================*/
/* Table : WITHDRAWALS                                          */
/*==============================================================*/
create table WITHDRAWALS
(
   ID_USER              int not null,
   ID_CASHBOX           int not null,
   ID_WITHDRAW          int AUTO_INCREMENT,
   DATE                 timestamp,
   AMOUNT               decimal,
   primary key (ID_WITHDRAW)
)ENGINE=InnoDB;

alter table CASHBOX add constraint FK_MANAGE foreign key (ID_USER)
      references USERS (ID_USER) on delete cascade on update cascade;

alter table DELIVERIES add constraint FK_RELATION_10 foreign key (ID_PRODUCT)
      references PRODUCTS (ID_PRODUCT) on delete cascade on update cascade;

alter table DELIVERIES add constraint FK_RELATION_11 foreign key (ID_SUPPLIER)
      references SUPPLIERS (ID_SUPPLIER) on delete cascade on update cascade;

alter table ORDERS add constraint FK_RELATION_3 foreign key (ID_CASHBOX)
      references CASHBOX (ID_CASHBOX) on delete cascade on update cascade;

alter table ORDERS add constraint FK_RELATION_4 foreign key (ID_CLIENT)
      references CLIENTS (ID_CLIENT) on delete cascade on update cascade;

alter table ORDERS add constraint FK_RELATION_5 foreign key (ID_PRODUCT)
      references PRODUCTS (ID_PRODUCT) on delete cascade on update cascade;

alter table PRODUCTS add constraint FK_HAVE foreign key (ID_TYPE)
      references TYPE (ID_TYPE) on delete cascade on update cascade;

alter table SUPPLY add constraint FK_RELATION_8 foreign key (ID_SUPPLIER)
      references SUPPLIERS (ID_SUPPLIER) on delete cascade on update cascade;

alter table SUPPLY add constraint FK_RELATION_9 foreign key (ID_USER)
      references USERS (ID_USER) on delete cascade on update cascade;

alter table WITHDRAWALS add constraint FK_RELATION_6 foreign key (ID_USER)
      references USERS (ID_USER) on delete cascade on update cascade;

alter table WITHDRAWALS add constraint FK_RELATION_7 foreign key (ID_CASHBOX)
      references CASHBOX (ID_CASHBOX) on delete cascade on update cascade;

