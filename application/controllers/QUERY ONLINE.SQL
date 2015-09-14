SELECT *, TIMESTAMPDIFF(MINUTE,`active_session`.`date_time`,NOW()) FROM 
`user`, `user_account_status`, `active_session` 
 where `user`.`id_user_status` =1 
 and `user`.`id_user_account_status`= `user_account_status`.`id_user_account_status` 
 and `user`.`id_user`= `active_session`.`id_user` and TIMESTAMPDIFF(MINUTE,`active_session`.`date_time`,NOW())< 60