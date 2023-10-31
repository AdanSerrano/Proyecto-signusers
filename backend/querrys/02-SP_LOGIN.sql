USE admin_users;

DROP PROCEDURE IF EXISTS SP_USUARIO_REGISTRO;
CREATE PROCEDURE SP_USUARIO_REGISTRO(
    IN p_nombre VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    -- Verificar si el correo ya existe en la base de datos
    IF (SELECT COUNT(*) FROM USER WHERE email = p_email) = 0 THEN
        -- Hashear la contraseña
        -- Insertar un nuevo usuario con la contraseña hasheada
        INSERT INTO USER (NAME, EMAIL, PASSWORD, createdAt, updatedAt)
        VALUES (p_nombre, p_email, PASSWORD(p_password), NOW(), NOW());
        SELECT 'Usuario registrado correctamente.' AS message;
    ELSE
        SELECT 'El correo ya está registrado. Por favor, elija otro correo.' AS message;
    END IF;
END;

-- LLAMAR AL PROCEDIMIENTO ALMACENADO
-- CALL SP_USUARIO_REGISTRO('Jorgeww', 'J@J.COM', '123');


-- CREAR EL SP LOGIN PARA INICIAR SESION
DROP PROCEDURE IF EXISTS SP_LOGIN;
CREATE PROCEDURE SP_LOGIN(
    IN p_email VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    IF (SELECT COUNT(*) FROM USER WHERE email = p_email) = 1 THEN
        IF (SELECT COUNT(*) FROM USER WHERE email = p_email AND password = PASSWORD(p_password)) = 1 THEN
            SELECT 'Inicio de sesión exitoso.' AS message;
        ELSE
            SELECT 'La contraseña es incorrecta.' AS message;
        END IF;
    ELSE
        SELECT 'El correo o la contraseña son inválidos.' AS message;
    END IF;
END; 

-- LLAMAR AL PROCEDIMIENTO ALMACENADO
-- CALL SP_LOGIN('J@J.COM', '123');