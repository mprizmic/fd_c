----da las salas de inicial localizadas en un establecimiento
select 
concat(e.apodo, ' ',ee.nombre) as establecimiento
,uo.id as uo_id
, ix.id as ix_id
, ix.matricula
, sa.grupo_etario_id, sa.q_secciones
from Fd.unidad_oferta uo
inner join Fd.localizacion l on l.id=uo.localizacion_id
inner join Fd.establecimiento_edificio ee on ee.id=l.establecimiento_edificio_id
inner join Fd.establecimiento e on e.id=ee.establecimientos_id
inner join Fd.inicial_x ix on ix.id=uo.inicial_id
left join Fd.sala sa on sa.inicial_x_id=ix.id