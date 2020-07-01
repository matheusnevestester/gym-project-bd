TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`%` TRIGGER exercicio_after_aparelho\nBEFORE DELETE\n   ON Aparelho FOR EACH ROW\n\nBEGIN\n   -- Insert record into audit table\n   DELETE FROM Exercicio WHERE maquina = OLD.id;\n\nEND'
sql_modes=1436549152
definers='root@%'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_general_ci'
db_cl_names='latin1_swedish_ci'
created=159355845914
