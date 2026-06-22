select * from usuario;
select * from produto;

select u.nome AS 'USUARIO',
p.nome_produto AS 'PRODUTO'
from usuario u 
join produto p
on p.id_usuario_fk = u.id_usuario;

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE usuario;
SET FOREIGN_KEY_CHECKS = 1;

SELECT * FROM produto WHERE id_usuario_fk = 1; 