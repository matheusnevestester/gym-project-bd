DELIMITER //

CREATE TRIGGER exercicio_after_aparelho
BEFORE DELETE
   ON Aparelho FOR EACH ROW

BEGIN
   -- Insert record into audit table
   DELETE FROM Exercicio WHERE maquina = OLD.id;

END; //

DELIMITER ;

DELIMITER //

CREATE TRIGGER usuario_on_delete
    BEFORE DELETE
    ON Usuario FOR EACH ROW

BEGIN
    -- Insert record into audit table
    DELETE FROM Aluno WHERE id_usuario = OLD.id;
    DELETE FROM Personal WHERE id_usuario = OLD.id;

END; //

DELIMITER ;

DELIMITER //

CREATE TRIGGER fix_aluno
    BEFORE DELETE
    ON Aluno FOR EACH ROW

BEGIN
    -- Insert record into audit table
    DELETE FROM Agendamento WHERE id_aluno = OLD.id;
    DELETE FROM Treino WHERE id_aluno = OLD.id;

END; //

DELIMITER ;

DELIMITER //

CREATE TRIGGER fix_personal
    BEFORE DELETE
    ON Personal FOR EACH ROW

BEGIN
    -- Insert record into audit table
    DELETE FROM Agendamento WHERE id_personal = OLD.id;

END; //

DELIMITER ;

DELIMITER //

CREATE TRIGGER treino_after_exercicio
    BEFORE DELETE
    ON Exercicio FOR EACH ROW

BEGIN
    -- Insert record into audit table
    DELETE FROM Treino WHERE id_exercicio = OLD.id;

END; //

DELIMITER ;

