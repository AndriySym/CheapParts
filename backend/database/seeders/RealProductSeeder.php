<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class RealProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // GPUs
            [
                'name' => 'NVIDIA GeForce RTX 4090 24GB GDDR6X',
                'description' => 'La tarjeta gráfica más potente del mercado. Arquitectura Ada Lovelace con 16384 CUDA Cores, 24GB GDDR6X, ideal para gaming 4K, ray tracing y creación de contenido profesional.',
                'stock' => 15,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx4090.jpg',
                'price_cents' => 189999, // 1899.99€
            ],
            [
                'name' => 'AMD Radeon RX 7900 XTX 24GB GDDR6',
                'description' => 'GPU de gama alta con arquitectura RDNA 3. 24GB de memoria, excelente para gaming 4K y renderizado. Competencia directa de las RTX serie 40.',
                'stock' => 22,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx7900xtx.png',
                'price_cents' => 99999, // 999.99€
            ],
            [
                'name' => 'NVIDIA GeForce RTX 4070 Ti 12GB',
                'description' => 'Tarjeta gráfica de gama media-alta perfecta para gaming 1440p y 4K. Ray tracing de última generación y DLSS 3.',
                'stock' => 34,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx4070ti.png',
                'price_cents' => 79999, // 799.99€
            ],
            [
                'name' => 'AMD Radeon RX 7600 8GB GDDR6',
                'description' => 'GPU de entrada ideal para gaming 1080p y 1440p. Excelente relación calidad-precio con soporte FSR 3.',
                'stock' => 45,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx7600.jpg',
                'price_cents' => 26999, // 269.99€
            ],

            // CPUs
            [
                'name' => 'AMD Ryzen 9 7950X 16-Core 5.7GHz',
                'description' => 'Procesador tope de gama con 16 núcleos y 32 hilos. Socket AM5, arquitectura Zen 4. Perfecto para gaming, streaming y workstation.',
                'stock' => 28,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen9-7950x.jpg',
                'price_cents' => 54999, // 549.99€
            ],
            [
                'name' => 'Intel Core i9-14900K 24-Core 6.0GHz',
                'description' => 'Procesador Intel de 14ª generación con 24 núcleos (8P+16E) y 32 hilos. Socket LGA1700, ideal para gaming extremo y multitarea.',
                'stock' => 19,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i9-14900k.jpg',
                'price_cents' => 58999, // 589.99€
            ],
            [
                'name' => 'AMD Ryzen 7 7800X3D 8-Core 5.0GHz',
                'description' => 'CPU con tecnología 3D V-Cache, el mejor procesador para gaming puro. 8 núcleos, 16 hilos y 96MB de caché L3.',
                'stock' => 31,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen7-7800x3d.jpg',
                'price_cents' => 44999, // 449.99€
            ],
            [
                'name' => 'Intel Core i5-14600K 14-Core 5.3GHz',
                'description' => 'Procesador de gama media-alta con 14 núcleos (6P+8E) y 20 hilos. Excelente para gaming y productividad.',
                'stock' => 52,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i5-14600k.jpg',
                'price_cents' => 31999, // 319.99€
            ],

            // RAM
            [
                'name' => 'Corsair Vengeance DDR5 32GB (2x16GB) 6000MHz',
                'description' => 'Memoria RAM DDR5 de alto rendimiento. 32GB en kit dual channel, perfecta para gaming y workstation. Latencia CL30.',
                'stock' => 67,
                'brand' => 'Corsair',
                'category' => 'RAM',
                'image_url' => '/images/products/corsair-vengeance-ddr5.jpg',
                'price_cents' => 12999, // 129.99€
            ],
            [
                'name' => 'G.Skill Trident Z5 RGB 64GB (2x32GB) 6400MHz',
                'description' => 'Kit de memoria DDR5 premium con iluminación RGB. 64GB para multitarea extrema, creación de contenido y gaming.',
                'stock' => 41,
                'brand' => 'G.Skill',
                'category' => 'RAM',
                'image_url' => '/images/products/gskill-trident-z5.jpg',
                'price_cents' => 24999, // 249.99€
            ],
            [
                'name' => 'Kingston Fury Beast DDR4 32GB (2x16GB) 3600MHz',
                'description' => 'Memoria DDR4 de alto rendimiento para plataformas AM4 e Intel gen 10-13. Excelente relación calidad-precio.',
                'stock' => 89,
                'brand' => 'Kingston',
                'category' => 'RAM',
                'image_url' => '/images/products/kingston-fury-ddr4.jpg',
                'price_cents' => 8999, // 89.99€
            ],

            // Storage
            [
                'name' => 'Samsung 990 PRO 2TB NVMe PCIe 4.0',
                'description' => 'SSD NVMe de última generación con velocidades de hasta 7450 MB/s lectura. Ideal para gaming y transferencias rápidas.',
                'stock' => 73,
                'brand' => 'Samsung',
                'category' => 'Storage',
                'image_url' => '/images/products/samsung-990pro.avif',
                'price_cents' => 15999, // 159.99€
            ],
            [
                'name' => 'WD Black SN850X 1TB NVMe PCIe 4.0',
                'description' => 'SSD gaming de Western Digital con hasta 7300 MB/s. Optimizado para PlayStation 5 y PC gaming.',
                'stock' => 95,
                'brand' => 'Western Digital',
                'category' => 'Storage',
                'image_url' => '/images/products/wd-black-sn850x.avif',
                'price_cents' => 8999, // 89.99€
            ],
            [
                'name' => 'Crucial P3 Plus 4TB NVMe PCIe 4.0',
                'description' => 'SSD de gran capacidad ideal para almacenar bibliotecas de juegos completas. Velocidades de hasta 5000 MB/s.',
                'stock' => 34,
                'brand' => 'Crucial',
                'category' => 'Storage',
                'image_url' => '/images/products/crucial-p3plus.webp',
                'price_cents' => 24999, // 249.99€
            ],

            // Motherboards
            [
                'name' => 'ASUS ROG STRIX X670E-E Gaming WiFi',
                'description' => 'Placa base premium AMD AM5 con chipset X670E. PCIe 5.0, DDR5, WiFi 6E y RGB Aura Sync. Perfecta para Ryzen 7000.',
                'stock' => 18,
                'brand' => 'ASUS',
                'category' => 'Motherboard',
                'image_url' => '/images/products/asus-rog-x670e.png',
                'price_cents' => 44999, // 449.99€
            ],
            [
                'name' => 'MSI MAG B650 TOMAHAWK WiFi',
                'description' => 'Placa base AMD B650 con excelente relación calidad-precio. Soporta Ryzen 7000, DDR5 y PCIe 4.0.',
                'stock' => 46,
                'brand' => 'MSI',
                'category' => 'Motherboard',
                'image_url' => '/images/products/msi-b650-tomahawk.jpg',
                'price_cents' => 22999, // 229.99€
            ],
            [
                'name' => 'Gigabyte Z790 AORUS ELITE AX',
                'description' => 'Placa base Intel Z790 para procesadores de 12ª, 13ª y 14ª gen. DDR5, PCIe 5.0 y conectividad WiFi 6E.',
                'stock' => 33,
                'brand' => 'Gigabyte',
                'category' => 'Motherboard',
                'image_url' => '/images/products/gigabyte-z790-aorus.jpg',
                'price_cents' => 29999, // 299.99€
            ],

            // PSU
            [
                'name' => 'Corsair RM1000x 1000W 80 Plus Gold Modular',
                'description' => 'Fuente de alimentación modular de 1000W con certificación 80 Plus Gold. Cables completamente modulares y ventilador silencioso.',
                'stock' => 55,
                'brand' => 'Corsair',
                'category' => 'PSU',
                'image_url' => '/images/products/corsair-rm1000x.jpg',
                'price_cents' => 16999, // 169.99€
            ],
            [
                'name' => 'Seasonic FOCUS GX-850 850W 80 Plus Gold',
                'description' => 'PSU semi-modular de 850W con eficiencia 80 Plus Gold. Ideal para sistemas de gama media-alta.',
                'stock' => 68,
                'brand' => 'Seasonic',
                'category' => 'PSU',
                'image_url' => '/images/products/seasonic-focus-gx850.jpg',
                'price_cents' => 12999, // 129.99€
            ],
            [
                'name' => 'be quiet! Straight Power 11 750W Platinum',
                'description' => 'Fuente modular premium con certificación 80 Plus Platinum. Componentes de alta calidad y funcionamiento silencioso.',
                'stock' => 41,
                'brand' => 'be quiet!',
                'category' => 'PSU',
                'image_url' => '/images/products/bequiet-sp11-750w.webp',
                'price_cents' => 14999, // 149.99€
            ],

            // Cases
            [
                'name' => 'Lian Li O11 Dynamic EVO',
                'description' => 'Caja ATX premium con diseño de doble cámara y cristal templado. Soporte para hasta 10 ventiladores y radiadores de 360mm.',
                'stock' => 29,
                'brand' => 'Lian Li',
                'category' => 'Case',
                'image_url' => '/images/products/lian-li-o11-dynamic.webp',
                'price_cents' => 16999, // 169.99€
            ],
            [
                'name' => 'NZXT H510 Flow',
                'description' => 'Caja mid-tower con excelente flujo de aire. Panel lateral de cristal templado y gestión de cables optimizada.',
                'stock' => 57,
                'brand' => 'NZXT',
                'category' => 'Case',
                'image_url' => '/images/products/nzxt-h510-flow.jpg',
                'price_cents' => 8999, // 89.99€
            ],
            [
                'name' => 'Fractal Design Torrent',
                'description' => 'Caja de alto flujo de aire con dos ventiladores de 180mm incluidos. Diseño minimalista y construcción robusta.',
                'stock' => 38,
                'brand' => 'Fractal Design',
                'category' => 'Case',
                'image_url' => '/images/products/fractal-torrent.jpg',
                'price_cents' => 19999, // 199.99€
            ],

            // Cooling
            [
                'name' => 'Noctua NH-D15 chromax.black',
                'description' => 'Disipador de aire dual-tower premium. Dos ventiladores NF-A15, compatibilidad universal y rendimiento silencioso excepcional.',
                'stock' => 64,
                'brand' => 'Noctua',
                'category' => 'Cooling',
                'image_url' => '/images/products/noctua-nhd15.jpg',
                'price_cents' => 10999, // 109.99€
            ],
            [
                'name' => 'Corsair iCUE H150i Elite LCD XT',
                'description' => 'Refrigeración líquida AIO de 360mm con pantalla LCD personalizable. Tres ventiladores RGB y software iCUE.',
                'stock' => 43,
                'brand' => 'Corsair',
                'category' => 'Cooling',
                'image_url' => '/images/products/corsair-h150i.jpg',
                'price_cents' => 25999, // 259.99€
            ],
            [
                'name' => 'Arctic Liquid Freezer II 280',
                'description' => 'AIO de 280mm con excelente relación calidad-precio. VRM cooling integrado y ventiladores P-series de alto rendimiento.',
                'stock' => 71,
                'brand' => 'Arctic',
                'category' => 'Cooling',
                'image_url' => '/images/products/arctic-lf2-280.webp',
                'price_cents' => 9999, // 99.99€
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
