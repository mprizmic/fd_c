--- oferta de una unidad educativa sin localizacion
select e.apodo, e.id as e_id
,ee.cue_anexo
,uo.id as uo_id
,uo.localizacion_id as localizacion_id
,uo.tipo
,n.abreviatura
,oe.id as oe_id
,oe.nivel_id oe_nivel_id
-- ,car.nombre, car.id as car_id
,tur.descripcion
from Fd.establecimiento e 
inner join Fd.establecimiento_edificio ee on ee.establecimientos_id=e.id
inner join Fd.localizacion l on l.establecimiento_edificio_id=ee.id
inner join Fd.unidad_educativa ue on ue.id=l.unidad_educativa_id
inner join Fd.nivel n on n.id=ue.nivel_id
inner join Fd.unidad_oferta uo on uo.localizacion_id=l.id
inner join Fd.oferta_educativa oe on oe.id=uo.oferta_educativa_id
left join Fd.unidadoferta_turno uot on uo.id=uot.unidad_oferta_id
left join Fd.carrera car on car.oferta_educativa_id=oe.id
left join Fd.secundario sec on sec.oferta_educativa_id=oe.id
left join Fd.turno tur on tur.id=uot.turno_id
where n.abreviatura ="Ter"
order by e.apodo, ee.cue_anexo, oe.nivel_id