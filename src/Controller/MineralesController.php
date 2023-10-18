<?php

namespace App\Controller;

use App\Entity\Cristalizacion;
use App\Entity\Mineral;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MineralesController extends AbstractController
{
    private $minerales = [
        // 1 => ["nombre" => "Diamante", "color" => "Azul", "densidad" => "3.52", "valor" => "10000"],
        // 2 => ["nombre" => "Rubí", "color" => "Rojo", "densidad" => "4", "valor" => "4500"],
        // 3 => ["nombre" => "Esmeralda", "color" => "Verde", "densidad" => "2.7", "valor" => "25000"],
        // 4 => ["nombre" => "Topacio imperial", "color" => "Naranja", "densidad" => "3.55", "valor" => "100000"],
        // 5 => ["nombre" => "Tungsteno", "color" => "Plateado", "densidad" => "19.25", "valor" => "60"],
        // 6 => ["nombre" => "Amatista", "color" => "Morado", "densidad" => "2.6", "valor" => "800"],
        // 7 => ["nombre" => "Jade", "color" => "Verde", "densidad" => "3.33", "valor" => "3000"]
    ];

    #[Route("mineral/insertar", name: 'insertar_mineral')]
    public function insertar(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        foreach ($this->minerales as $c) {
            $mineral = new Mineral();
            $mineral->setNombre($c["nombre"]);
            $mineral->setColor($c["color"]);
            $mineral->setDensidad(intval($c["densidad"]));
            $mineral->setValor(intval($c["valor"]));
            $entityManager->persist($mineral);
        }
        try {
            $entityManager->flush();
            return new Response("Minerales insertados");
        } catch (\Exception $e) {
            return new Response("Error insertando objetos");
        }
    }

    #[Route('/minerales', name: 'app_listaMinerales')]
    public function allMinerales(ManagerRegistry $doctrine): Response
    {
        $repositorio = $doctrine->getRepository(Mineral::class);
        $minerales = $repositorio->findAll();
        return $this->render('minerales/lista_minerales.html.twig', ['minerales' => $minerales]);
    }

    #[Route('/mineral/{codigo}', name: 'app_minerales')]
    public function mineral(ManagerRegistry $doctrine, int $codigo = 1): Response
    {
        $repositorio = $doctrine->getRepository(Mineral::class);
        $mineral = $repositorio->find($codigo);

        return $this->render('minerales/ficha_mineral.html.twig', ['mineral' => $mineral]);
    }

    #[Route('/mineral/buscar/{texto}', name: 'app_mineral_buscar')]
    public function buscar(ManagerRegistry $doctrine, string $texto): Response
    {
        $repositorio = $doctrine->getRepository(Mineral::class);
        $minerales = $repositorio->findByNombre($texto);

        return $this->render('minerales/lista_minerales.html.twig', ['minerales' => $minerales]);
    }

    #[Route('/mineral/updatePrice/{id}/{precio}', name: 'update_precio_mineral')]
    public function updatePrice(ManagerRegistry $doctrine, int $id, int $precio)
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Mineral::class);
        $mineral = $repositorio->find($id);
        if ($mineral) {
            $mineral->setValor($precio);
            try {
                $entityManager->flush();
                return $this->render('minerales/ficha_mineral.html.twig', ['mineral' => $mineral]);
            } catch (\Exception $e) {
                return new Response("Error al actualizar los datos");
            }
        } else {
            return $this->render('minerales/ficha_mineral.html.twig', ['mineral' => null]);
        }
    }

    #[Route('/mineral/delete/{id}', name: 'delete_mineral')]
    public function delete(ManagerRegistry $doctrine, int $id)
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Mineral::class);
        $mineral = $repositorio->find($id);
        if ($mineral) {
            try {
                $entityManager->remove($mineral);
                $entityManager->flush();
                return new Response("Mineral eliminado");
            } catch (\Exception $e) {
                return new Response("Error al elminar el mineral");
            }
        } else {
            return $this->render('minerales/ficha_mineral.html.twig', ['mineral' => null]);
        }
    }

    #[Route('/mineral/insertarconforma/{nombre}/{color}/{densidad}/{valor}/{cristalizacion}', name: 'insertar_con_forma')]
    public function insConForma(ManagerRegistry $doctrine, string $nombre, string $color, int $densidad, int $valor, string $cristalizacion)
    {
        $entityManager = $doctrine->getManager();
        $crist = new Cristalizacion();

        $crist->setNombre($cristalizacion);
        $mineral = new Mineral();

        $mineral->setNombre($nombre);
        $mineral->setColor($color);
        $mineral->setDensidad($densidad);
        $mineral->setValor($valor);
        $mineral->setCristalizacion($crist);

        $entityManager->persist($crist);
        $entityManager->persist($mineral);

        try {
            $entityManager->flush();
            return $this->render('minerales/ficha_mineral.html.twig', ['mineral' => $mineral]);
        } catch (\Exception $e) {
            return new Response("Error insertar el mineral");
        }
    }

    #[Route('/mineral/updateCrist/{id}/{cristalizacion}', name: 'update_cristalizacion')]
    public function updateCrist(ManagerRegistry $doctrine, int $id, int $cristalizacion)
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Mineral::class);
        $mineral = $repositorio->find($id);
        if ($mineral) {
            $mineral->setCristalizacion($cristalizacion);
            try {
                $entityManager->flush();
                return $this->render('minerales/ficha_mineral.html.twig', ['mineral' => $mineral]);
            } catch (\Exception $e) {
                return new Response("Error al actualizar los datos");
            }
        } else {
            return $this->render('minerales/ficha_mineral.html.twig', ['mineral' => null]);
        }
    }

    #[Route('/mineral/insertarSinCrist/{nombre}/{color}/{densidad}/{valor}/{cristalizacion}', name: 'insertar_sin_cristalizacion')]
    public function insSinCrist(ManagerRegistry $doctrine, string $nombre, string $color, int $densidad, int $valor, string $cristalizacion)
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Cristalizacion::class);

        $crist = $repositorio->findOneBy(['nombre' => $cristalizacion]);

        $mineral = new Mineral();

        $mineral->setNombre($nombre);
        $mineral->setColor($color);
        $mineral->setDensidad($densidad);
        $mineral->setValor($valor);
        $mineral->setCristalizacion($crist);

        $entityManager->persist($mineral);

        try {
            $entityManager->flush();
            return $this->render('minerales/ficha_mineral.html.twig', ['mineral' => $mineral]);
        } catch (\Exception $e) {
            return new Response("Error insertar el mineral");
        }
    }
}
