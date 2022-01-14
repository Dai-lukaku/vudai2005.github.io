-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 26, 2020 lúc 03:04 PM
-- Phiên bản máy phục vụ: 10.3.23-MariaDB-cll-lve
-- Phiên bản PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phandinh_linhcoder`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buffcomment`
--

CREATE TABLE `buffcomment` (
  `id` int(11) NOT NULL,
  `idpost` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `noidung` text NOT NULL,
  `tongthanhtoan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bufflike`
--

CREATE TABLE `bufflike` (
  `id` int(11) NOT NULL,
  `idpost` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `camxuc` int(11) NOT NULL,
  `tongthanhtoan` int(11) NOT NULL,
  `ghichu` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bufflike`
--

INSERT INTO `bufflike` (`id`, `idpost`, `soluong`, `camxuc`, `tongthanhtoan`, `ghichu`, `status`, `time`, `username`) VALUES
(17, '1443287322516694', 375, 2, 45000, NULL, 1, 1593012020, 'Nguyenduyhoang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bufflikepage`
--

CREATE TABLE `bufflikepage` (
  `id` int(11) NOT NULL,
  `idpage` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongthanhtoan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buffshare`
--

CREATE TABLE `buffshare` (
  `id` int(11) NOT NULL,
  `idpost` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongthanhtoan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `buffshare`
--

INSERT INTO `buffshare` (`id`, `idpost`, `soluong`, `tongthanhtoan`, `status`, `time`, `username`) VALUES
(7, '100', 5, 5000, 0, 1593088896, 'PHANDINHHUNG'),
(8, '1212121', 5, 5000, 0, 1593098292, 'PHANDINHHUNG');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buffsub`
--

CREATE TABLE `buffsub` (
  `id` int(11) NOT NULL,
  `idprofile` varchar(100) NOT NULL,
  `loai` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongthanhtoan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buffsubtiktok`
--

CREATE TABLE `buffsubtiktok` (
  `id` int(11) NOT NULL,
  `idpost` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongthanhtoan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bufftiktok`
--

CREATE TABLE `bufftiktok` (
  `id` int(11) NOT NULL,
  `idpost` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongthanhtoan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `idrip` varchar(100) NOT NULL,
  `ib` text NOT NULL,
  `loai` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tongthanhtoan` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `to9xvn_napthenhanh`
--

CREATE TABLE `to9xvn_napthenhanh` (
  `ID` bigint(20) NOT NULL,
  `uid` varchar(32) NOT NULL,
  `sotien` int(11) NOT NULL,
  `seri` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  `loaithe` varchar(32) NOT NULL,
  `time` varchar(32) NOT NULL,
  `noidung` text NOT NULL,
  `tinhtrang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `to9xvn_napthenhanh`
--

INSERT INTO `to9xvn_napthenhanh` (`ID`, `uid`, `sotien`, `seri`, `code`, `loaithe`, `time`, `noidung`, `tinhtrang`) VALUES
(20, '68', 10000, '33333322222', '1111112222222', 'VIETTEL', '1593157433', '53379f8182a25f3900d2431105abbfcb nạp thẻ  ', 1),
(21, '68', 10000, '33333333339', '3333333333333', 'VIETTEL', '1593157726', 'e0a8587b55b65f77f1dd8d0d59be01f6 nạp thẻ  ', 2),
(22, '64', 10000, '12211111111', '9999991119999', 'VIETTEL', '1593157875', '48439d09164fea25d6395491519ffb86 nạp thẻ  ', 1),
(23, '64', 10000, '33333323333', '3333332322222', 'VIETTEL', '1593158233', '543ecc01931a474f859d60cbf795af38 nạp thẻ  ', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `vnd` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `vnd`) VALUES
(22, 'tdthanhk1', '27102001', 9800000),
(23, 'iamhoangvanlinh', 'iamhoangvanlinh', 0),
(20, 'PHANDINHHUNG', 'PHANDINHHUNGTRAGIANG12345', 992023000),
(24, 'thtri226', '111111111', 0),
(25, 'huylangco12', 'huylangco12', 0),
(26, 'đasadasdaa', 'đasadasdaa', 0),
(27, 'tuanhung.dvfb', 'hunghung180', 0),
(29, 'Nammedia', 'namdzdzdz', 0),
(30, 'iamhoangvanlinh2k3', 'iamhoangvanlinh2k3', 0),
(31, 'Nhật Trường', 'haicondien', 0),
(32, 'tungyang', '20032005', 0),
(33, 'Abcabc123', 'abcabc123', 0),
(34, 'mailco', '5720019uc', 847720),
(35, 'levandungvn', 'Dung12345', 0),
(36, 'Nguyenduyhoang', 'hoang321', 0),
(37, 'Adminiztrator', 'abcd@1234', 0),
(38, 'kaisa.1champ', '99999999', 0),
(39, 'Khuong1222399', 'Khuongak6', 0),
(40, 'lethimyhuyen', 'uylovehuyen', 0),
(41, 'Vietlan', 'matkhau1', 0),
(42, 'Hiamtabu', 'tin24072000', 0),
(43, 'Thuc', '123456789', 0),
(44, 'bincongtu', 'bincongtu123', 0),
(45, 'krushquan113', 'krush123', 0),
(46, 'Ni', '101804', 0),
(47, 'Ptcquan', 'quanquan11', 0),
(48, 'Krushquan', 'quankrush', 0),
(49, 'Babydontcry1', 'long1', 0),
(50, 'Hau', 'tienhau95', 0),
(51, 'ccccccc55', '112233', 0),
(54, 'nguyenprodz2006', 'nguyendz', 0),
(55, 'kietdz2020', 'dangtuankiet000', 0),
(56, 'Hieucot1002', 'tqh10021991', 0),
(60, 'a\" or \"1=1\";', 'a\" or \"1=1\";', 0),
(58, 'buakg5', 'thanh123', 0),
(59, 'maithanhtri123', 'gaugaugau', 0),
(61, '1/\" or \"1=1\";', '1/\" or \"1=1\";', 0),
(62, 'asdfasdfasdf', 'asdfasdfasdf', 0),
(63, 'Bô đẹp trai', '123456789', 0),
(64, 'kkkkkk', 'kkkkkk', 10000),
(65, 'Cẩm nhàn', '1234512345', 0),
(66, 'con cặc \'\' ', 'con cặc \'\' ', 0),
(67, '<script.alert(\'vcl\')</script>', '<script.alert(\'vcl\')</script>', 0),
(68, '<script>alert(\"vcl\")</script>', '<script>alert(\"vcl\")</script>', 10000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `viplike`
--

CREATE TABLE `viplike` (
  `id` int(11) NOT NULL,
  `idvip` varchar(100) NOT NULL,
  `name` text DEFAULT NULL,
  `hsd` int(11) NOT NULL,
  `loai` int(11) NOT NULL,
  `time_die` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `buffcomment`
--
ALTER TABLE `buffcomment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bufflike`
--
ALTER TABLE `bufflike`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bufflikepage`
--
ALTER TABLE `bufflikepage`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `buffshare`
--
ALTER TABLE `buffshare`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `buffsub`
--
ALTER TABLE `buffsub`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `buffsubtiktok`
--
ALTER TABLE `buffsubtiktok`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bufftiktok`
--
ALTER TABLE `bufftiktok`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `to9xvn_napthenhanh`
--
ALTER TABLE `to9xvn_napthenhanh`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `viplike`
--
ALTER TABLE `viplike`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `buffcomment`
--
ALTER TABLE `buffcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `bufflike`
--
ALTER TABLE `bufflike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `bufflikepage`
--
ALTER TABLE `bufflikepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `buffshare`
--
ALTER TABLE `buffshare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `buffsub`
--
ALTER TABLE `buffsub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `buffsubtiktok`
--
ALTER TABLE `buffsubtiktok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `bufftiktok`
--
ALTER TABLE `bufftiktok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `to9xvn_napthenhanh`
--
ALTER TABLE `to9xvn_napthenhanh`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `viplike`
--
ALTER TABLE `viplike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
