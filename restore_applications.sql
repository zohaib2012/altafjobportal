SET FOREIGN_KEY_CHECKS=0;

-- Remove conflicting live applications (same application_id as backup)
DELETE FROM challans WHERE application_id IN (SELECT id FROM applications WHERE application_id IN ('NEPH-2026-00001','NEPH-2026-00002'));
DELETE FROM documents WHERE application_id IN (SELECT id FROM applications WHERE application_id IN ('NEPH-2026-00001','NEPH-2026-00002'));
DELETE FROM applications WHERE application_id IN ('NEPH-2026-00001','NEPH-2026-00002');

-- Restore users from backup (skip duplicates by email)
INSERT IGNORE INTO `users` (`id`,`name`,`email`,`password`,`application_id`,`role`,`remember_token`,`created_at`,`updated_at`) VALUES
(2,'hamza','hamza@gmail.com','$2y$12$r9vkXucGxWybPsdynEu26.DwUzhORbOmPnl/D2.Ull7DlfGGaFoYO',2,'candidate',NULL,'2026-04-27 11:44:34','2026-04-27 11:45:04'),
(3,'alia','alia@gmail.com','$2y$12$OI4tyR56naUencDz8LULyOefZwAQH5pb7Rr29KGoQrqfFXjN.0nnC',3,'candidate',NULL,'2026-04-27 11:46:19','2026-04-27 11:46:19'),
(4,'Javed','altafhussainb161@gmail.com','$2y$12$90hW/zmoLMNSm0Y3KfOzEOGrmQWUNcwsoSxP1PF8pEnjYpdPVlo92',5,'candidate',NULL,'2026-04-27 11:54:16','2026-04-27 12:16:09'),
(5,'Ali','altafhussainbirhmani376@gmail.com','$2y$12$eI1n7wvwSgZXSivQdt3w3OUYNBVPdFOoooEwyX1gkVRy9sXEZaza.',6,'candidate',NULL,'2026-04-27 12:18:37','2026-04-27 12:18:37'),
(6,'wazeer','altafhussainbirhmani@gmail.com','$2y$12$0yC8qN4F2fluxsbDDlqMJOs4unTvWWJZ42/zfvkOf8jJEm3UTDSM.',7,'candidate',NULL,'2026-04-27 13:51:24','2026-04-27 13:51:24'),
(7,'BISMA','bisma@gmail.com','$2y$12$9gHBuSWSbduivlqijckpMeY.cWLe/7uK9ikrRVY6kVR3fx.39evbO',8,'candidate',NULL,'2026-04-27 16:01:32','2026-04-27 16:01:32'),
(8,'Muhammad Rizwan Ullah','rizwantravels8@gmail.com','$2y$12$ylbWuY6aBLY4ReIv3FQBIetbm5j.kJaVdgFeL/GxHi5Jp5khtlYp2',9,'candidate',NULL,'2026-04-27 16:14:54','2026-04-27 16:14:54');

-- Restore applications from backup
INSERT IGNORE INTO `applications` (`id`,`application_id`,`full_name`,`father_name`,`cnic`,`date_of_birth`,`mobile`,`email`,`address`,`qualification`,`position_id`,`status`,`admin_notes`,`created_at`,`updated_at`) VALUES
(1,'NEPH-2026-00001','hamza','ali','21392-1839218-3','2026-04-11','2139-2183921','hamza@gmail.com','Gujrat,punjab,pakistan','Matric',1,'pending',NULL,'2026-04-27 11:44:33','2026-04-27 11:44:33'),
(2,'NEPH-2026-00002','hamza','ali','21392-1839211-2','2026-04-11','2139-2183921','hamza@gmail.com','Gujrat,punjab,pakistan','Matric',1,'pending',NULL,'2026-04-27 11:45:04','2026-04-27 11:45:04'),
(3,'NEPH-2026-00003','alia','akj','23787-8172832-1','2026-04-23','2232-3232323','alia@gmail.com','Gujrat,punjab,pakistan','Matric',5,'shortlisted','shortlisted','2026-04-27 11:46:19','2026-04-27 11:48:24'),
(4,'NEPH-2026-00004','Javed','Gulab','41506-0404598-0','2022-03-08','0305-3124404','altafhussainb161@gmail.com','Jamshoro','Intermediate',10,'pending',NULL,'2026-04-27 11:54:15','2026-04-27 11:54:15'),
(5,'NEPH-2026-00005','Zain','Gulab','41202-4509980-1','2026-04-12','0304-5559023','altafhussainb161@gmail.com','Karachi','Bachelor',4,'pending',NULL,'2026-04-27 12:16:09','2026-04-27 12:16:09'),
(6,'NEPH-2026-00006','Ali','Zain','4150604045901','2026-04-13','0306-3511003','altafhussainbirhmani376@gmail.com','Karachi','Master',2,'pending',NULL,'2026-04-27 12:18:37','2026-04-27 12:18:37'),
(7,'NEPH-2026-00007','wazeer','ali','41205-5677006-5','2026-04-06','0305-3466890','altafhussainbirhmani@gmail.com','hyderabad','Matric',4,'pending',NULL,'2026-04-27 13:51:23','2026-04-27 13:51:23'),
(8,'NEPH-2026-00008','BISMA','PARYAL','41506-0403569-0','2026-04-05','0306-7499012','bisma@gmail.com','Jamshoro','Matric',1,'pending',NULL,'2026-04-27 16:01:32','2026-04-27 16:01:32'),
(9,'NEPH-2026-00009','Muhammad Rizwan Ullah','Zakir Ullah Shah','4240144394147','1999-02-01','0336-8070404','rizwantravels8@gmail.com','Orangi Town Sector 10 Karachi','Bachelor',2,'pending',NULL,'2026-04-27 16:14:54','2026-04-27 16:14:54');

-- Restore challans
INSERT IGNORE INTO `challans` (`id`,`challan_no`,`application_id`,`fee_amount`,`bank_charges`,`total_amount`,`generated_at`,`is_fee_verified`,`fee_verified_at`,`fee_verified_by`) VALUES
(1,'NEPH-2026-00001',1,300.00,0.00,300.00,'2026-04-27 11:44:33',0,NULL,NULL),
(2,'NEPH-2026-00002',2,300.00,0.00,300.00,'2026-04-27 11:45:04',0,NULL,NULL),
(3,'NEPH-2026-00003',3,300.00,0.00,300.00,'2026-04-27 11:46:19',0,NULL,NULL),
(4,'NEPH-2026-00004',4,300.00,0.00,300.00,'2026-04-27 11:54:15',0,NULL,NULL),
(5,'NEPH-2026-00005',5,300.00,0.00,300.00,'2026-04-27 12:16:09',0,NULL,NULL),
(6,'NEPH-2026-00006',6,300.00,0.00,300.00,'2026-04-27 12:18:37',0,NULL,NULL),
(7,'NEPH-2026-00007',7,300.00,0.00,300.00,'2026-04-27 13:51:23',0,NULL,NULL),
(8,'NEPH-2026-00008',8,300.00,0.00,300.00,'2026-04-27 16:01:32',0,NULL,NULL),
(9,'NEPH-2026-00009',9,300.00,0.00,300.00,'2026-04-27 16:14:54',0,NULL,NULL);

-- Restore documents
INSERT IGNORE INTO `documents` (`id`,`application_id`,`cv_path`,`cv_original_name`,`cv_size`,`cv_uploaded_at`,`challan_path`,`challan_original_name`,`challan_size`,`challan_uploaded_at`,`created_at`,`updated_at`) VALUES
(1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-04-27 11:44:33','2026-04-27 11:44:33'),
(2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-04-27 11:45:04','2026-04-27 11:45:04'),
(3,3,'uploads/cvs/7At44O0cI6jFgklPcvbHJAb2wH4eV94nRC3DDm6t.pdf','Challan-NEPH-2026-00002.pdf',4724,'2026-04-27 11:46:55','uploads/challans/j3gT9xobIAiq3AAKhZgIrQJNzcMKfseagC0kTuKV.jpg','WhatsApp Image 2026-04-19 at 23.35.21.jpeg',69170,'2026-04-27 11:46:55','2026-04-27 11:46:19','2026-04-27 11:46:55'),
(4,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-04-27 11:54:15','2026-04-27 11:54:15'),
(5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-04-27 12:16:09','2026-04-27 12:16:09'),
(6,6,'uploads/cvs/0r7QXVBdjyX69S36Txl9VYOsChcruUdQi0CvABQc.pdf','Challan-NEPH-2026-00006.pdf',4725,'2026-04-27 12:21:08','uploads/challans/kBSYzFKs1kZh4QLyeWwobsMOtKHzHNbTMlMKQJsC.pdf','Challan-NEPH-2026-00005.pdf',4728,'2026-04-27 12:21:08','2026-04-27 12:18:37','2026-04-27 12:21:08'),
(7,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-04-27 13:51:23','2026-04-27 13:51:23'),
(8,8,'uploads/cvs/LtdzLtdAvHJ60FN7uYuP8yKOLF9R6jKNgLH0dfKB.pdf','Challan-NEPH-2026-00008.pdf',4734,'2026-04-27 16:05:36','uploads/challans/p5WplnRlGmVFImeyp8uvb3eMQQiTWjRKjggRbyom.jpg','Screenshot_20260427_210144.jpg',522624,'2026-04-27 16:05:36','2026-04-27 16:01:32','2026-04-27 16:05:36'),
(9,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-04-27 16:14:54','2026-04-27 16:14:54');

SET FOREIGN_KEY_CHECKS=1;
