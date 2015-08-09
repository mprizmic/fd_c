--- orientaciones de las NES por escuela
select e.apodo, e.id as e_id
,ee.cue_anexo
,uo.id as uo_id
,uo.localizacion_id as localizacion_id
,uo.tipo
,sx.id as sx_id
,mo.nombre as orientacion
from Fd.establecimiento e 
inner join Fd.establecimiento_edificio ee on ee.establecimientos_id=e.id
inner join Fd.localizacion l on l.establecimiento_edificio_id=ee.id
inner join Fd.unidad_oferta uo on uo.localizacion_id=l.id
left join Fd.secundario_x sx on sx.id=uo.secundario_id
left join Fd.secundariox_orientacion so on sx.id=so.secundariox_id
left join Fd.media_orientaciones mo on mo.id=so.orientacion_id
where uo.tipo ='Secundario'
order by e.apodo, ee.cue_anexo
