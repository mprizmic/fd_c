--- agenda
select 
e.apodo
, ee.id as ee_id
,pe.id as pe_id
,oi.id as  oi_id
,d.nombre
,cg.nombre
,cg.id as cg_id
from agenda_fd.plantel_establecimiento pe
inner join agenda_fd.organizacion_interna oi on oi.id=pe.organizacion_id
inner join agenda_fd.establecimiento_edificio ee on ee.id=oi.establecimiento_id
inner join agenda_fd.establecimiento e on e.id=ee.establecimientos_id
inner join agenda_fd.dependencia d on d.id=oi.dependencia_id
inner join agenda_fd.cargo cg on cg.id=pe.cargo_id
where e.apodo="ENS 2"
