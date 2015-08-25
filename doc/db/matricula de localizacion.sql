        select 
            e.apodo as establecimiento
            ,e.cue as cue
            ,ee.cue_anexo as anexo
            ,ee.nombre as nombre_anexo
            ,n.nombre as nivel
            ,loc.matricula as matricula
            ,com.numero as comuna
            ,dies.numero as DE
                from Fd.establecimiento e
                inner join Fd.establecimiento_edificio ee on ee.establecimientos_id=e.id
                inner join Fd.edificio ed on ed.id=ee.edificios_id
                inner join Fd.localizacion loc on loc.establecimiento_edificio_id=ee.id
                inner join Fd.unidad_educativa ue on loc.unidad_educativa_id=ue.id
                inner join Fd.nivel n on n.id=ue.nivel_id
                inner join Fd.comuna com on com.id=ed.comuna_id
                inner join Fd.distrito_escolar dies on dies.id=ed.distrito_escolar_id
                    where ee.cue_anexo <> '99'
                    order by e.orden, ee.cue_anexo, n.orden;
