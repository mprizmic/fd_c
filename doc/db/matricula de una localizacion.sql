select 
uo.id
,e.apodo
,ee.nombre
,car.nombre
,co.anio 
,co.matricula_ingresantes
,co.matricula
,co.egreso
,co.matricula
from Fd.unidad_oferta uo
left join Fd.cohorte co on co.unidad_oferta_id=uo.id
inner join Fd.localizacion l on l.id=uo.localizacion_id
inner join Fd.oferta_educativa oe on oe.id=uo.oferta_educativa_id
inner join Fd.carrera car on car.oferta_educativa_id=oe.id
inner join Fd.establecimiento_edificio ee on ee.id=l.establecimiento_edificio_id
inner join Fd.establecimiento e on e.id=ee.establecimientos_id
where co.matricula is not null

