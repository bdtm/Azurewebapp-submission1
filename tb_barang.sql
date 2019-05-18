-- =========================================
-- Create table template Windows Azure SQL Database 
-- =========================================

create table barang
  (kode varchar(10) primary key,
  nama_barang varchar(10),
  qty int,
  Hargabeli int,
  Hargajual int)
