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

            // Nuevos productos añadidos
            [
                'name' => 'AMD Ryzen 5 7600X 6-Core 5.3GHz',
                'description' => 'Procesador de gama media con arquitectura Zen 4. 6 núcleos y 12 hilos, perfecto para gaming 1440p. Compatible con DDR5 y PCIe 5.0. TDP 105W.',
                'stock' => 45,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen5-7600x.avif',
                'price_cents' => 27999, // 279.99€
            ],
            [
                'name' => 'NVIDIA GeForce RTX 4060 Ti 8GB',
                'description' => 'Tarjeta gráfica perfecta para gaming 1080p y 1440p con tecnología DLSS 3. Ray Tracing de última generación, bajo consumo energético 160W.',
                'stock' => 50,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx4060ti.webp',
                'price_cents' => 49999, // 499.99€
            ],
            [
                'name' => 'G.Skill Ripjaws V DDR4 32GB (2x16GB) 3600MHz',
                'description' => 'Memoria RAM de alto rendimiento sin RGB. 32GB en dual channel, CAS Latency CL16. Ideal para gaming y productividad sin luces.',
                'stock' => 65,
                'brand' => 'G.Skill',
                'category' => 'RAM',
                'image_url' => '/images/products/gskill-ripjaws-v-32gb.png',
                'price_cents' => 9999, // 99.99€
            ],
            [
                'name' => 'Kingston KC3000 1TB NVMe PCIe 4.0',
                'description' => 'SSD NVMe de alto rendimiento con velocidades de hasta 7000 MB/s lectura. Ideal para gaming y aplicaciones exigentes. Incluye disipador.',
                'stock' => 40,
                'brand' => 'Kingston',
                'category' => 'Storage',
                'image_url' => '/images/products/kingston-kc3000-1tb.webp',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'ASRock B650 Pro RS AM5',
                'description' => 'Placa base AMD B650 para procesadores Ryzen 7000. PCIe 5.0, DDR5, 10 fases de alimentación. Formato ATX con conectividad completa.',
                'stock' => 30,
                'brand' => 'ASRock',
                'category' => 'Motherboard',
                'image_url' => '/images/products/asrock-b650-pro-rs.webp',
                'price_cents' => 19999, // 199.99€
            ],
            [
                'name' => 'EVGA SuperNOVA 750W 80+ Gold Modular',
                'description' => 'Fuente de alimentación modular con certificación 80+ Gold. 750W de potencia, cables sleeved, ventilador silencioso 140mm. Garantía 10 años.',
                'stock' => 35,
                'brand' => 'EVGA',
                'category' => 'PSU',
                'image_url' => '/images/products/evga-supernova-750w.png',
                'price_cents' => 12999, // 129.99€
            ],
            [
                'name' => 'Corsair 4000D Airflow Tempered Glass',
                'description' => 'Torre ATX con excelente flujo de aire. Panel frontal de malla, cristal templado lateral, soporte para refrigeración líquida hasta 360mm.',
                'stock' => 42,
                'brand' => 'Corsair',
                'category' => 'Case',
                'image_url' => '/images/products/corsair-4000d-airflow.avif',
                'price_cents' => 10499, // 104.99€
            ],
            [
                'name' => 'be quiet! Dark Rock Pro 4',
                'description' => 'Disipador de CPU de alto rendimiento con doble torre. Dos ventiladores Silent Wings PWM, TDP 250W. Compatible con Intel y AMD.',
                'stock' => 28,
                'brand' => 'be quiet!',
                'category' => 'Cooling',
                'image_url' => '/images/products/bequiet-dark-rock-pro4.jpg',
                'price_cents' => 8999, // 89.99€
            ],
            [
                'name' => 'Intel Core i7-13700K 16-Core 5.4GHz',
                'description' => 'Procesador de 13ª generación con arquitectura híbrida. 8 P-cores + 8 E-cores, 24 hilos. Perfecto para gaming y creación de contenido.',
                'stock' => 32,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i7-13700k.webp',
                'price_cents' => 42999, // 429.99€
            ],
            [
                'name' => 'AMD Radeon RX 7800 XT 16GB GDDR6',
                'description' => 'GPU de gama media-alta con arquitectura RDNA 3. 16GB VRAM, perfecta para gaming 1440p y 4K. Excelente relación rendimiento/precio.',
                'stock' => 38,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx7800xt.jpg',
                'price_cents' => 54999, // 549.99€
            ],

            // 20 PRODUCTOS ADICIONALES
            // CPUs
            [
                'name' => 'Intel Core i3-13100F 4-Core 4.5GHz',
                'description' => 'Procesador económico de 13ª generación sin gráficos integrados. 4 núcleos, 8 hilos, perfecto para builds de presupuesto ajustado.',
                'stock' => 55,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i3-13100f.jpg',
                'price_cents' => 12999, // 129.99€
            ],
            [
                'name' => 'AMD Ryzen 9 7900X 12-Core 5.4GHz',
                'description' => 'Procesador de alta gama con 12 núcleos y 24 hilos. Arquitectura Zen 4, ideal para multitarea intensiva y creación de contenido.',
                'stock' => 28,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen9-7900x.jpg',
                'price_cents' => 52999, // 529.99€
            ],
            [
                'name' => 'Intel Core i5-12400F 6-Core 4.4GHz',
                'description' => 'Procesador de 12ª generación con excelente relación calidad-precio. 6 núcleos, 12 hilos, ideal para gaming 1080p y 1440p.',
                'stock' => 62,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i5-12400f.jpg',
                'price_cents' => 17999, // 179.99€
            ],
            [
                'name' => 'AMD Ryzen 7 5800X3D 8-Core 4.5GHz',
                'description' => 'Procesador con tecnología 3D V-Cache para gaming extremo. 8 núcleos, rendimiento excepcional en juegos, compatible con AM4.',
                'stock' => 25,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen7-5800x3d.webp',
                'price_cents' => 34999, // 349.99€
            ],

            // GPUs
            [
                'name' => 'NVIDIA GeForce RTX 4070 12GB',
                'description' => 'GPU de gama media-alta ideal para gaming 1440p. DLSS 3, Ray Tracing, consumo eficiente. Excelente equilibrio rendimiento/precio.',
                'stock' => 42,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx4070.jpg',
                'price_cents' => 64999, // 649.99€
            ],
            [
                'name' => 'AMD Radeon RX 6750 XT 12GB',
                'description' => 'Tarjeta gráfica RDNA 2 para gaming 1440p. 12GB VRAM, excelente para juegos AAA y streaming simultáneo.',
                'stock' => 35,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx6750xt.jpg',
                'price_cents' => 44999, // 449.99€
            ],
            [
                'name' => 'NVIDIA GeForce RTX 3060 12GB',
                'description' => 'GPU popular para gaming 1080p y 1440p. 12GB VRAM, Ray Tracing, DLSS 2.0. Gran disponibilidad y soporte.',
                'stock' => 68,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx3060.png',
                'price_cents' => 32999, // 329.99€
            ],
            [
                'name' => 'AMD Radeon RX 7700 XT 12GB',
                'description' => 'GPU RDNA 3 de gama media con 12GB VRAM. Perfecto balance entre rendimiento y precio para gaming 1440p.',
                'stock' => 40,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx7700xt.jpg',
                'price_cents' => 47999, // 479.99€
            ],

            // RAM
            [
                'name' => 'Corsair Dominator Platinum RGB DDR5 32GB 6000MHz',
                'description' => 'Memoria premium DDR5 con RGB personalizable. 32GB dual channel, 6000MHz, diseño premium con disipador de aluminio.',
                'stock' => 30,
                'brand' => 'Corsair',
                'category' => 'RAM',
                'image_url' => '/images/products/corsair-dominator-ddr5-32gb.avif',
                'price_cents' => 24999, // 249.99€
            ],
            [
                'name' => 'Crucial Ballistix DDR4 16GB (2x8GB) 3200MHz',
                'description' => 'Memoria RAM económica y confiable. 16GB dual channel, CL16, perfecta para builds de presupuesto medio.',
                'stock' => 75,
                'brand' => 'Crucial',
                'category' => 'RAM',
                'image_url' => '/images/products/crucial-ballistix-16gb.webp',
                'price_cents' => 5999, // 59.99€
            ],
            [
                'name' => 'TeamGroup T-Force Delta RGB DDR5 32GB 5600MHz',
                'description' => 'Memoria DDR5 con iluminación RGB direccionable. 32GB, 5600MHz, diseño agresivo y excelente rendimiento.',
                'stock' => 45,
                'brand' => 'TeamGroup',
                'category' => 'RAM',
                'image_url' => '/images/products/teamgroup-delta-ddr5-32gb.jpg',
                'price_cents' => 14999, // 149.99€
            ],

            // Storage
            [
                'name' => 'Crucial P5 Plus 2TB NVMe PCIe 4.0',
                'description' => 'SSD NVMe de alto rendimiento con 2TB de capacidad. Velocidades de hasta 6600 MB/s, ideal para gaming y productividad.',
                'stock' => 32,
                'brand' => 'Crucial',
                'category' => 'Storage',
                'image_url' => '/images/products/crucial-p5-plus-2tb.webp',
                'price_cents' => 17999, // 179.99€
            ],
            [
                'name' => 'Seagate Barracuda 2TB HDD 7200RPM',
                'description' => 'Disco duro mecánico de 2TB para almacenamiento masivo. 7200 RPM, caché 256MB, perfecto como disco secundario.',
                'stock' => 50,
                'brand' => 'Seagate',
                'category' => 'Storage',
                'image_url' => '/images/products/seagate-barracuda-2tb.jpg',
                'price_cents' => 5999, // 59.99€
            ],
            [
                'name' => 'WD Blue SN570 1TB NVMe',
                'description' => 'SSD NVMe económico con buen rendimiento. 1TB, velocidades hasta 3500 MB/s, ideal para actualizar desde HDD.',
                'stock' => 58,
                'brand' => 'Western Digital',
                'category' => 'Storage',
                'image_url' => '/images/products/wd-blue-sn570-1tb.webp',
                'price_cents' => 7999, // 79.99€
            ],

            // Motherboards
            [
                'name' => 'ASUS TUF Gaming B760-Plus WiFi',
                'description' => 'Placa base Intel B760 con WiFi 6. Compatible con CPUs de 12ª y 13ª gen, DDR5, PCIe 5.0. Diseño militar TUF.',
                'stock' => 35,
                'brand' => 'ASUS',
                'category' => 'Motherboard',
                'image_url' => '/images/products/asus-tuf-b760.jpg',
                'price_cents' => 22999, // 229.99€
            ],
            [
                'name' => 'MSI MAG B550 Tomahawk',
                'description' => 'Placa base AMD B550 para Ryzen 5000. PCIe 4.0, DDR4, excelente VRM para overclocking. Muy popular entre gamers.',
                'stock' => 40,
                'brand' => 'MSI',
                'category' => 'Motherboard',
                'image_url' => '/images/products/msi-mag-b550.webp',
                'price_cents' => 17999, // 179.99€
            ],

            // PSU
            [
                'name' => 'Thermaltake Toughpower GF1 850W 80+ Gold',
                'description' => 'Fuente modular 850W con certificación 80+ Gold. Ventilador hidráulico silencioso, cables flat, garantía 10 años.',
                'stock' => 38,
                'brand' => 'Thermaltake',
                'category' => 'PSU',
                'image_url' => '/images/products/thermaltake-gf1-850w.webp',
                'price_cents' => 14999, // 149.99€
            ],
            [
                'name' => 'Cooler Master MWE 650W 80+ Bronze',
                'description' => 'Fuente de alimentación semi-modular certificada 80+ Bronze. 650W, protecciones completas, excelente para builds medios.',
                'stock' => 52,
                'brand' => 'Cooler Master',
                'category' => 'PSU',
                'image_url' => '/images/products/coolermaster-mwe-650w.jpg',
                'price_cents' => 6999, // 69.99€
            ],

            // Cases
            [
                'name' => 'Phanteks Eclipse P400A Digital RGB',
                'description' => 'Torre ATX con panel de malla frontal y 3 ventiladores RGB. Excelente flujo de aire, cristal templado, gestión de cables optimizada.',
                'stock' => 33,
                'brand' => 'Phanteks',
                'category' => 'Case',
                'image_url' => '/images/products/phanteks-p400a.jpg',
                'price_cents' => 11999, // 119.99€
            ],

            // Cooling
            [
                'name' => 'Cooler Master Hyper 212 Black Edition',
                'description' => 'Disipador de aire legendario actualizado. Diseño negro, ventilador silencioso, TDP 150W. Compatible con todos los sockets modernos.',
                'stock' => 70,
                'brand' => 'Cooler Master',
                'category' => 'Cooling',
                'image_url' => '/images/products/coolermaster-hyper212.avif',
                'price_cents' => 4999, // 49.99€
            ],
            [
                'name' => 'NZXT Kraken X63 280mm AIO RGB',
                'description' => 'Refrigeración líquida AIO de 280mm con pantalla LCD personalizable. RGB integrado, bomba mejorada, excelente rendimiento térmico.',
                'stock' => 25,
                'brand' => 'NZXT',
                'category' => 'Cooling',
                'image_url' => '/images/products/nzxt-kraken-x63.jpg',
                'price_cents' => 17999, // 179.99€
            ],
            [
                'name' => 'Deepcool AK620 Tower Cooler',
                'description' => 'Disipador de torre dual económico con excelente rendimiento. 2 ventiladores 120mm, TDP 260W, gran alternativa a modelos premium.',
                'stock' => 48,
                'brand' => 'Deepcool',
                'category' => 'Cooling',
                'image_url' => '/images/products/deepcool-ak620.webp',
                'price_cents' => 6499, // 64.99€
            ],

            // Cases adicionales
            [
                'name' => 'be quiet! Pure Base 500DX',
                'description' => 'Torre ATX con diseño silencioso y excelente flujo de aire. 3 ventiladores Pure Wings, panel lateral de cristal, gestión de cables premium.',
                'stock' => 30,
                'brand' => 'be quiet!',
                'category' => 'Case',
                'image_url' => '/images/products/bequiet-pure-base-500dx.jpg',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'Lian Li Lancool II Mesh',
                'description' => 'Torre ATX premium con panel frontal de malla. Excelente refrigeración, construcción sólida, espacio para hardware high-end.',
                'stock' => 22,
                'brand' => 'Lian Li',
                'category' => 'Case',
                'image_url' => '/images/products/lian-li-lancool-ii.jpg',
                'price_cents' => 13999, // 139.99€
            ],

            // Peripherals - Teclados y ratones
            [
                'name' => 'Ratón Logitech G Pro X Superlight',
                'description' => 'Ratón gaming inalámbrico ultraligero. Sensor HERO 25K, 63 gramos, batería 70 horas. Perfecto para esports.',
                'stock' => 40,
                'brand' => 'Logitech',
                'category' => 'Peripherals',
                'image_url' => '/images/products/logitech-gpro-superlight.jpg',
                'price_cents' => 13999, // 139.99€
            ],
            [
                'name' => 'Teclado Razer BlackWidow V3 Mechanical',
                'description' => 'Teclado mecánico gaming con switches Razer Green. RGB Chroma, reposamuñecas ergonómico, construcción premium.',
                'stock' => 35,
                'brand' => 'Razer',
                'category' => 'Peripherals',
                'image_url' => '/images/products/razer-blackwidow-v3.jpg',
                'price_cents' => 14999, // 149.99€
            ],
            [
                'name' => 'Teclado Corsair K70 RGB MK.2 Cherry MX Red',
                'description' => 'Teclado mecánico con switches Cherry MX Red. Aluminio cepillado, RGB por tecla, reposamuñecas desmontable.',
                'stock' => 42,
                'brand' => 'Corsair',
                'category' => 'Peripherals',
                'image_url' => '/images/products/corsair-k70-rgb.jpg',
                'price_cents' => 16999, // 169.99€
            ],

            // Monitores
            [
                'name' => 'ASUS TUF Gaming VG27AQ 27" 1440p 165Hz',
                'description' => 'Monitor gaming IPS 27 pulgadas WQHD. 165Hz, 1ms GTG, G-Sync compatible, HDR10. Excelente para gaming competitivo.',
                'stock' => 28,
                'brand' => 'ASUS',
                'category' => 'Monitor',
                'image_url' => '/images/products/asus-tuf-vg27aq.webp',
                'price_cents' => 34999, // 349.99€
            ],
            [
                'name' => 'Samsung Odyssey G7 32" 1440p 240Hz Curved',
                'description' => 'Monitor gaming curvo 1000R de 32 pulgadas. 240Hz, 1ms, QLED, HDR600. Inmersión total para gaming.',
                'stock' => 18,
                'brand' => 'Samsung',
                'category' => 'Monitor',
                'image_url' => '/images/products/samsung-odyssey-g7.webp',
                'price_cents' => 59999, // 599.99€
            ],
            [
                'name' => 'LG UltraGear 24" 1080p 144Hz IPS',
                'description' => 'Monitor gaming compacto Full HD. 144Hz, 1ms, IPS, AMD FreeSync. Perfecto para gaming 1080p de alto rendimiento.',
                'stock' => 50,
                'brand' => 'LG',
                'category' => 'Monitor',
                'image_url' => '/images/products/lg-ultragear-24.webp',
                'price_cents' => 19999, // 199.99€
            ],

            // 50 PRODUCTOS NUEVOS
            // CPUs
            [
                'name' => 'Intel Core i7-14700K 20-Core 5.5GHz',
                'description' => 'Procesador Intel de 14ª generación con 20 núcleos (8P+12E) y 28 hilos. Socket LGA1700, excelente para gaming y productividad. Overclocking desbloqueado.',
                'stock' => 35,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i7-14700k.jpg',
                'price_cents' => 45999, // 459.99€
            ],
            [
                'name' => 'AMD Ryzen 5 5600X 6-Core 4.6GHz',
                'description' => 'Procesador de gama media con arquitectura Zen 3. 6 núcleos y 12 hilos, perfecto para gaming 1080p y 1440p. Compatible con AM4 y DDR4.',
                'stock' => 48,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen5-5600x.webp',
                'price_cents' => 19999, // 199.99€
            ],
            [
                'name' => 'Intel Core i5-13600K 14-Core 5.1GHz',
                'description' => 'Procesador de 13ª generación con 14 núcleos (6P+8E) y 20 hilos. Excelente relación calidad-precio para gaming y multitarea.',
                'stock' => 42,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i5-13600k.jpg',
                'price_cents' => 29999, // 299.99€
            ],
            [
                'name' => 'AMD Ryzen 7 5700X 8-Core 4.6GHz',
                'description' => 'Procesador de gama media-alta con arquitectura Zen 3. 8 núcleos y 16 hilos, perfecto para gaming y multitarea. Socket AM4, sin gráficos integrados, TDP 65W.',
                'stock' => 40,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen7-5700x.webp',
                'price_cents' => 24999, // 249.99€
            ],
            [
                'name' => 'Intel Core i9-13900K 24-Core 5.8GHz',
                'description' => 'Procesador tope de gama de 13ª generación. 24 núcleos (8P+16E) y 32 hilos, máximo rendimiento para gaming extremo y workstation.',
                'stock' => 22,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i9-13900k.jpg',
                'price_cents' => 57999, // 579.99€
            ],

            // GPUs
            [
                'name' => 'NVIDIA GeForce RTX 4080 16GB GDDR6X',
                'description' => 'GPU de gama alta con arquitectura Ada Lovelace. 16GB VRAM, DLSS 3, Ray Tracing de última generación. Perfecta para gaming 4K.',
                'stock' => 18,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx4080.webp',
                'price_cents' => 119999, // 1199.99€
            ],
            [
                'name' => 'AMD Radeon RX 6600 XT 8GB GDDR6',
                'description' => 'GPU RDNA 2 para gaming 1080p y 1440p. 8GB VRAM, excelente relación calidad-precio. Ideal para builds de gama media.',
                'stock' => 45,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx6600xt.png',
                'price_cents' => 32999, // 329.99€
            ],
            [
                'name' => 'NVIDIA GeForce RTX 3050 8GB GDDR6',
                'description' => 'GPU de entrada con Ray Tracing y DLSS. 8GB VRAM, perfecta para gaming 1080p. Excelente para builds económicas.',
                'stock' => 55,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx3050.jpg',
                'price_cents' => 27999, // 279.99€
            ],
            [
                'name' => 'AMD Radeon RX 6500 XT 4GB GDDR6',
                'description' => 'GPU económica RDNA 2 para gaming 1080p. 4GB VRAM, ideal para builds de presupuesto muy ajustado.',
                'stock' => 50,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx6500xt.jpg',
                'price_cents' => 19999, // 199.99€
            ],
            [
                'name' => 'NVIDIA GeForce RTX 3080 10GB GDDR6X',
                'description' => 'GPU de gama alta de la serie 30. 10GB VRAM, excelente para gaming 1440p y 4K. Ray Tracing y DLSS 2.0.',
                'stock' => 15,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx3080.jpg',
                'price_cents' => 69999, // 699.99€
            ],

            // RAM
            [
                'name' => 'Kingston FURY Renegade DDR5 16GB (2x8GB) 6000MHz',
                'description' => 'Memoria DDR5 de alto rendimiento. 16GB dual channel, 6000MHz, latencia CL32. Perfecta para gaming y overclocking.',
                'stock' => 52,
                'brand' => 'Kingston',
                'category' => 'RAM',
                'image_url' => '/images/products/kingston-fury-renegade-ddr5-16gb.jpg',
                'price_cents' => 8999, // 89.99€
            ],
            [
                'name' => 'Corsair Vengeance LPX DDR4 16GB (2x8GB) 3200MHz',
                'description' => 'Memoria DDR4 de perfil bajo sin RGB. 16GB dual channel, 3200MHz, ideal para builds compactas y gaming.',
                'stock' => 68,
                'brand' => 'Corsair',
                'category' => 'RAM',
                'image_url' => '/images/products/corsair-vengeance-lpx-16gb.jpg',
                'price_cents' => 6999, // 69.99€
            ],
            [
                'name' => 'G.Skill Flare X5 DDR5 16GB (2x8GB) 5600MHz',
                'description' => 'Memoria DDR5 optimizada para AMD Ryzen. 16GB dual channel, 5600MHz, compatible con EXPO. Sin RGB.',
                'stock' => 48,
                'brand' => 'G.Skill',
                'category' => 'RAM',
                'image_url' => '/images/products/gskill-flare-x5-16gb.jpg',
                'price_cents' => 7999, // 79.99€
            ],
            [
                'name' => 'TeamGroup Vulcan Z DDR4 32GB (2x16GB) 3600MHz',
                'description' => 'Memoria DDR4 económica con buen rendimiento. 32GB dual channel, 3600MHz, diseño agresivo sin RGB.',
                'stock' => 40,
                'brand' => 'TeamGroup',
                'category' => 'RAM',
                'image_url' => '/images/products/teamgroup-vulcan-z-32gb.jpg',
                'price_cents' => 10999, // 109.99€
            ],
            [
                'name' => 'ADATA XPG Lancer DDR5 32GB (2x16GB) 6000MHz',
                'description' => 'Memoria DDR5 con diseño futurista. 32GB dual channel, 6000MHz, RGB direccionable. Excelente para builds gaming.',
                'stock' => 35,
                'brand' => 'ADATA',
                'category' => 'RAM',
                'image_url' => '/images/products/adata-xpg-lancer-32gb.jpg',
                'price_cents' => 13999, // 139.99€
            ],

            // Storage
            [
                'name' => 'Samsung 980 PRO 1TB NVMe PCIe 4.0',
                'description' => 'SSD NVMe de alto rendimiento. 1TB, velocidades hasta 7000 MB/s lectura. Ideal para gaming y aplicaciones exigentes.',
                'stock' => 55,
                'brand' => 'Samsung',
                'category' => 'Storage',
                'image_url' => '/images/products/samsung-980pro-1tb.jpeg',
                'price_cents' => 9999, // 99.99€
            ],
            [
                'name' => 'WD Black SN770 2TB NVMe PCIe 4.0',
                'description' => 'SSD gaming de Western Digital sin DRAM. 2TB, velocidades hasta 5150 MB/s. Excelente relación capacidad/precio.',
                'stock' => 38,
                'brand' => 'Western Digital',
                'category' => 'Storage',
                'image_url' => '/images/products/wd-black-sn770-2tb.jpg',
                'price_cents' => 12999, // 129.99€
            ],
            [
                'name' => 'Crucial MX4 1TB SATA SSD',
                'description' => 'SSD SATA económico y confiable. 1TB, velocidades hasta 560 MB/s. Perfecto para actualizar desde HDD o como almacenamiento secundario.',
                'stock' => 65,
                'brand' => 'Crucial',
                'category' => 'Storage',
                'image_url' => '/images/products/crucial-mx4-1tb.jpg',
                'price_cents' => 6999, // 69.99€
            ],
            [
                'name' => 'Seagate FireCuda 530 1TB NVMe PCIe 4.0',
                'description' => 'SSD gaming premium con velocidades extremas. 1TB, hasta 7300 MB/s lectura, optimizado para PlayStation 5 y PC gaming.',
                'stock' => 28,
                'brand' => 'Seagate',
                'category' => 'Storage',
                'image_url' => '/images/products/seagate-firecuda-530-1tb.webp',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'Kingston NV2 2TB NVMe PCIe 4.0',
                'description' => 'SSD NVMe económico con gran capacidad. 2TB, velocidades hasta 3500 MB/s. Ideal para almacenar bibliotecas de juegos.',
                'stock' => 42,
                'brand' => 'Kingston',
                'category' => 'Storage',
                'image_url' => '/images/products/kingston-nv2-2tb.jpg',
                'price_cents' => 10999, // 109.99€
            ],
            [
                'name' => 'Sabrent Rocket 4 Plus 1TB NVMe PCIe 4.0',
                'description' => 'SSD NVMe de alto rendimiento con controlador Phison. 1TB, velocidades hasta 7000 MB/s, disipador incluido.',
                'stock' => 30,
                'brand' => 'Sabrent',
                'category' => 'Storage',
                'image_url' => '/images/products/sabrent-rocket-4plus-1tb.jpg',
                'price_cents' => 10499, // 104.99€
            ],

            // Motherboards
            [
                'name' => 'ASUS ROG STRIX B550-F Gaming WiFi',
                'description' => 'Placa base AMD B550 premium con WiFi 6. Compatible con Ryzen 5000, PCIe 4.0, DDR4. RGB Aura Sync y excelente VRM.',
                'stock' => 32,
                'brand' => 'ASUS',
                'category' => 'Motherboard',
                'image_url' => '/images/products/asus-rog-strix-b550f.png',
                'price_cents' => 19999, // 199.99€
            ],
            [
                'name' => 'MSI MPG Z690 Carbon WiFi',
                'description' => 'Placa base Intel Z690 premium con WiFi 6E. Compatible con CPUs de 12ª y 13ª gen, DDR5, PCIe 5.0. Diseño gaming con RGB.',
                'stock' => 25,
                'brand' => 'MSI',
                'category' => 'Motherboard',
                'image_url' => '/images/products/msi-mpg-z690-carbon.png',
                'price_cents' => 34999, // 349.99€
            ],
            [
                'name' => 'Gigabyte B650M AORUS Elite AX',
                'description' => 'Placa base AMD B650 micro-ATX con WiFi 6E. Compatible con Ryzen 7000, DDR5, PCIe 5.0. Excelente para builds compactas.',
                'stock' => 38,
                'brand' => 'Gigabyte',
                'category' => 'Motherboard',
                'image_url' => '/images/products/gigabyte-b650m-aorus.webp',
                'price_cents' => 18999, // 189.99€
            ],
            [
                'name' => 'ASRock X570 Taichi',
                'description' => 'Placa base AMD X570 premium con chipset activo. Compatible con Ryzen 5000, PCIe 4.0, excelente para overclocking y workstation.',
                'stock' => 20,
                'brand' => 'ASRock',
                'category' => 'Motherboard',
                'image_url' => '/images/products/asrock-x570-taichi.webp',
                'price_cents' => 29999, // 299.99€
            ],
            [
                'name' => 'ASUS Prime Z790-P WiFi',
                'description' => 'Placa base Intel Z790 con WiFi 6. Compatible con CPUs de 12ª, 13ª y 14ª gen, DDR5, PCIe 5.0. Excelente relación calidad-precio.',
                'stock' => 40,
                'brand' => 'ASUS',
                'category' => 'Motherboard',
                'image_url' => '/images/products/asus-prime-z790p.jpg',
                'price_cents' => 22999, // 229.99€
            ],

            // PSU
            [
                'name' => 'Corsair RM850x 850W 80+ Gold Modular',
                'description' => 'Fuente de alimentación modular de 850W con certificación 80+ Gold. Cables completamente modulares, ventilador silencioso, garantía 10 años.',
                'stock' => 45,
                'brand' => 'Corsair',
                'category' => 'PSU',
                'image_url' => '/images/products/corsair-rm850x.jpg',
                'price_cents' => 14999, // 149.99€
            ],
            [
                'name' => 'be quiet! Pure Power 12 750W 80+ Gold',
                'description' => 'Fuente modular 750W con certificación 80+ Gold. Componentes de alta calidad, funcionamiento silencioso, cables flat.',
                'stock' => 50,
                'brand' => 'be quiet!',
                'category' => 'PSU',
                'image_url' => '/images/products/bequiet-pure-power-12-750w.jpg',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'Seasonic Prime TX-1000 1000W 80+ Titanium',
                'description' => 'Fuente premium con certificación 80+ Titanium. 1000W, máxima eficiencia, componentes de primera calidad. Ideal para builds high-end.',
                'stock' => 15,
                'brand' => 'Seasonic',
                'category' => 'PSU',
                'image_url' => '/images/products/seasonic-prime-tx1000.jpg',
                'price_cents' => 24999, // 249.99€
            ],
            [
                'name' => 'EVGA SuperNOVA 850W 80+ Gold Modular',
                'description' => 'Fuente modular 850W con certificación 80+ Gold. Cables sleeved, ventilador silencioso, protecciones completas. Garantía 10 años.',
                'stock' => 35,
                'brand' => 'EVGA',
                'category' => 'PSU',
                'image_url' => '/images/products/evga-supernova-850w.jpg',
                'price_cents' => 13999, // 139.99€
            ],
            [
                'name' => 'Cooler Master V850 Gold V2 850W',
                'description' => 'Fuente modular 850W con certificación 80+ Gold. Ventilador hidráulico, cables flat, diseño compacto. Excelente para builds gaming.',
                'stock' => 42,
                'brand' => 'Cooler Master',
                'category' => 'PSU',
                'image_url' => '/images/products/coolermaster-v850-gold.jpg',
                'price_cents' => 12999, // 129.99€
            ],

            // Cases
            [
                'name' => 'Fractal Design Meshify 2',
                'description' => 'Torre ATX con panel frontal de malla para máximo flujo de aire. Cristal templado lateral, gestión de cables optimizada, diseño minimalista.',
                'stock' => 28,
                'brand' => 'Fractal Design',
                'category' => 'Case',
                'image_url' => '/images/products/fractal-meshify-2.jpg',
                'price_cents' => 14999, // 149.99€
            ],
            [
                'name' => 'Cooler Master MasterBox TD500 Mesh',
                'description' => 'Torre ATX con panel frontal de malla y 3 ventiladores RGB. Excelente flujo de aire, cristal templado, diseño agresivo.',
                'stock' => 35,
                'brand' => 'Cooler Master',
                'category' => 'Case',
                'image_url' => '/images/products/coolermaster-td500-mesh.webp',
                'price_cents' => 10999, // 109.99€
            ],
            [
                'name' => 'ASUS TUF Gaming GT501',
                'description' => 'Torre full-tower gaming con diseño militar. Panel lateral de cristal, excelente espacio, soporte para E-ATX. Incluye 4 ventiladores.',
                'stock' => 22,
                'brand' => 'ASUS',
                'category' => 'Case',
                'image_url' => '/images/products/asus-tuf-gt501.png',
                'price_cents' => 17999, // 179.99€
            ],
            [
                'name' => 'NZXT H7 Flow',
                'description' => 'Torre ATX con panel frontal de malla mejorado. Excelente flujo de aire, cristal templado, diseño limpio y moderno.',
                'stock' => 30,
                'brand' => 'NZXT',
                'category' => 'Case',
                'image_url' => '/images/products/nzxt-h7-flow.jpg',
                'price_cents' => 13999, // 139.99€
            ],
            [
                'name' => 'Phanteks Enthoo Pro 2',
                'description' => 'Torre full-tower premium con diseño modular. Panel lateral de cristal, excelente gestión de cables, soporte para E-ATX y múltiples radiadores.',
                'stock' => 18,
                'brand' => 'Phanteks',
                'category' => 'Case',
                'image_url' => '/images/products/phanteks-enthoo-pro2.jpg',
                'price_cents' => 19999, // 199.99€
            ],

            // Cooling
            [
                'name' => 'Noctua NH-U12A',
                'description' => 'Disipador de aire de torre única premium. Dos ventiladores NF-A12x25, compatibilidad universal, rendimiento silencioso excepcional.',
                'stock' => 55,
                'brand' => 'Noctua',
                'category' => 'Cooling',
                'image_url' => '/images/products/noctua-nhu12a.jpg',
                'price_cents' => 9999, // 99.99€
            ],
            [
                'name' => 'be quiet! Pure Loop 2 FX 360mm AIO',
                'description' => 'Refrigeración líquida AIO de 360mm con RGB. Bomba externa, tres ventiladores Pure Wings 2, excelente rendimiento térmico.',
                'stock' => 32,
                'brand' => 'be quiet!',
                'category' => 'Cooling',
                'image_url' => '/images/products/bequiet-pure-loop-2fx-360.jpg',
                'price_cents' => 14999, // 149.99€
            ],
            [
                'name' => 'Arctic Liquid Freezer II 360',
                'description' => 'AIO de 360mm con excelente relación calidad-precio. VRM cooling integrado, ventiladores P-series, rendimiento excepcional.',
                'stock' => 48,
                'brand' => 'Arctic',
                'category' => 'Cooling',
                'image_url' => '/images/products/arctic-lf2-360.jpg',
                'price_cents' => 10999, // 109.99€
            ],
            [
                'name' => 'Deepcool LS720 360mm AIO',
                'description' => 'Refrigeración líquida AIO de 360mm con RGB direccionable. Tres ventiladores RGB, bomba mejorada, excelente para builds gaming.',
                'stock' => 38,
                'brand' => 'Deepcool',
                'category' => 'Cooling',
                'image_url' => '/images/products/deepcool-ls720-360.webp',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'Scythe Fuma 2 Rev.B',
                'description' => 'Disipador de torre dual económico con excelente rendimiento. Dos ventiladores silenciosos, TDP 250W, compatibilidad universal.',
                'stock' => 45,
                'brand' => 'Scythe',
                'category' => 'Cooling',
                'image_url' => '/images/products/scythe-fuma-2.webp',
                'price_cents' => 5999, // 59.99€
            ],

            // Peripherals
            [
                'name' => 'Teclado SteelSeries Apex Pro TKL',
                'description' => 'Teclado mecánico TKL con switches ajustables OmniPoint. RGB por tecla, reposamuñecas magnético, perfecto para gaming competitivo.',
                'stock' => 28,
                'brand' => 'SteelSeries',
                'category' => 'Peripherals',
                'image_url' => '/images/products/steelseries-apex-pro-tkl.jpg',
                'price_cents' => 19999, // 199.99€
            ],
            [
                'name' => 'Ratón Razer DeathAdder V3 Pro',
                'description' => 'Ratón gaming inalámbrico con sensor Focus Pro 30K. 63 gramos, batería 90 horas, perfecto para esports y gaming competitivo.',
                'stock' => 35,
                'brand' => 'Razer',
                'category' => 'Peripherals',
                'image_url' => '/images/products/razer-deathadder-v3-pro.webp',
                'price_cents' => 14999, // 149.99€
            ],
            [
                'name' => 'Ratón Logitech G502 X Plus',
                'description' => 'Ratón gaming inalámbrico con sensor HERO 25K. RGB LIGHTSYNC, 11 botones programables, diseño ergonómico mejorado.',
                'stock' => 40,
                'brand' => 'Logitech',
                'category' => 'Peripherals',
                'image_url' => '/images/products/logitech-g502-x-plus.png',
                'price_cents' => 12999, // 129.99€
            ],
            [
                'name' => 'Teclado HyperX Alloy Elite 2',
                'description' => 'Teclado mecánico gaming con switches HyperX Red. RGB por tecla, reposamuñecas desmontable, construcción sólida de aluminio.',
                'stock' => 32,
                'brand' => 'HyperX',
                'category' => 'Peripherals',
                'image_url' => '/images/products/hyperx-alloy-elite-2.jpg',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'Ratón Corsair Scimitar RGB Elite',
                'description' => 'Ratón MMO gaming con 17 botones programables. Sensor óptico 18K DPI, RGB por zona, diseño ergonómico para juegos MMO.',
                'stock' => 25,
                'brand' => 'Corsair',
                'category' => 'Peripherals',
                'image_url' => '/images/products/corsair-scimitar-rgb-elite.avif',
                'price_cents' => 8999, // 89.99€
            ],

            // Monitors
            [
                'name' => 'Acer Predator X27 27" 4K 144Hz',
                'description' => 'Monitor gaming premium 4K UHD de 27 pulgadas. 144Hz, G-Sync HDR, HDR1000, panel IPS. Máximo rendimiento para gaming 4K.',
                'stock' => 12,
                'brand' => 'Acer',
                'category' => 'Monitor',
                'image_url' => '/images/products/acer-predator-x27.jpg',
                'price_cents' => 99999, // 999.99€
            ],
            [
                'name' => 'MSI Optix MAG274QRF-QD 27" 1440p 165Hz',
                'description' => 'Monitor gaming IPS de 27 pulgadas WQHD. 165Hz, 1ms GTG, Quantum Dot, HDR400. Excelente calidad de color y gaming.',
                'stock' => 30,
                'brand' => 'MSI',
                'category' => 'Monitor',
                'image_url' => '/images/products/msi-optix-mag274qrf.jpg',
                'price_cents' => 39999, // 399.99€
            ],
            [
                'name' => 'LG 27GL850-B 27" 1440p 144Hz',
                'description' => 'Monitor gaming IPS Nano de 27 pulgadas. 144Hz, 1ms, G-Sync compatible, HDR10. Excelente para gaming y productividad.',
                'stock' => 35,
                'brand' => 'LG',
                'category' => 'Monitor',
                'image_url' => '/images/products/lg-27gl850.jpg',
                'price_cents' => 32999, // 329.99€
            ],
            [
                'name' => 'BenQ ZOWIE XL2566K 24.5" 1080p 360Hz',
                'description' => 'Monitor gaming competitivo de 24.5 pulgadas. 360Hz, 0.5ms, TN panel, optimizado para esports. Sin distracciones, máximo rendimiento.',
                'stock' => 20,
                'brand' => 'BenQ',
                'category' => 'Monitor',
                'image_url' => '/images/products/benq-zowie-xl2566k.webp',
                'price_cents' => 59999, // 599.99€
            ],

            // 50 PRODUCTOS NUEVOS
            // CPUs
            [
                'name' => 'Intel Core i3-14100 4-Core 4.7GHz',
                'description' => 'Procesador económico de 14ª generación con 4 núcleos y 8 hilos. Socket LGA1700, perfecto para builds de presupuesto ajustado y ofimática.',
                'stock' => 60,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i3-14100.webp',
                'price_cents' => 13999, // 139.99€
            ],
            [
                'name' => 'AMD Ryzen 3 5300G 4-Core 4.2GHz',
                'description' => 'Procesador con gráficos integrados Radeon. 4 núcleos y 8 hilos, perfecto para builds sin tarjeta gráfica dedicada. Socket AM4.',
                'stock' => 55,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen3-5300g.png',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'Intel Core i5-14400 10-Core 4.7GHz',
                'description' => 'Procesador de 14ª generación con 10 núcleos (6P+4E) y 16 hilos. Excelente relación calidad-precio para gaming y productividad.',
                'stock' => 48,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i5-14400.jpg',
                'price_cents' => 22999, // 229.99€
            ],
            [
                'name' => 'AMD Ryzen 5 7500F 6-Core 5.0GHz',
                'description' => 'Procesador de gama media sin gráficos integrados. 6 núcleos y 12 hilos, arquitectura Zen 4, perfecto para gaming 1440p.',
                'stock' => 42,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen5-7500f.webp',
                'price_cents' => 19999, // 199.99€
            ],
            [
                'name' => 'Intel Core i7-12700K 12-Core 5.0GHz',
                'description' => 'Procesador de 12ª generación con 12 núcleos (8P+4E) y 20 hilos. Socket LGA1700, excelente para gaming y creación de contenido.',
                'stock' => 30,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i7-12700k.webp',
                'price_cents' => 38999, // 389.99€
            ],
            [
                'name' => 'AMD Ryzen 9 7900X3D 12-Core 5.6GHz',
                'description' => 'Procesador premium con tecnología 3D V-Cache. 12 núcleos y 24 hilos, máximo rendimiento para gaming y workstation.',
                'stock' => 18,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen9-7900x3d.jpg',
                'price_cents' => 59999, // 599.99€
            ],
            [
                'name' => 'Intel Core i5-13500 14-Core 4.8GHz',
                'description' => 'Procesador de 13ª generación con 14 núcleos (6P+8E) y 20 hilos. Excelente para gaming y multitarea sin overclocking.',
                'stock' => 45,
                'brand' => 'Intel',
                'category' => 'CPU',
                'image_url' => '/images/products/i5-13500.jpg',
                'price_cents' => 24999, // 249.99€
            ],
            [
                'name' => 'AMD Ryzen 7 7700X 8-Core 5.4GHz',
                'description' => 'Procesador de gama alta con arquitectura Zen 4. 8 núcleos y 16 hilos, perfecto para gaming y productividad. Socket AM5.',
                'stock' => 35,
                'brand' => 'AMD',
                'category' => 'CPU',
                'image_url' => '/images/products/ryzen7-7700x.jpg',
                'price_cents' => 39999, // 399.99€
            ],

            // GPUs
            [
                'name' => 'NVIDIA GeForce RTX 4060 8GB',
                'description' => 'GPU de gama media para gaming 1080p y 1440p. DLSS 3, Ray Tracing, bajo consumo. Excelente relación calidad-precio.',
                'stock' => 52,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx4060.jpg',
                'price_cents' => 34999, // 349.99€
            ],
            [
                'name' => 'AMD Radeon RX 7600 XT 16GB',
                'description' => 'GPU RDNA 3 con 16GB VRAM. Perfecta para gaming 1440p y 4K, excelente relación rendimiento/precio.',
                'stock' => 38,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx7600xt.jpg',
                'price_cents' => 32999, // 329.99€
            ],
            [
                'name' => 'NVIDIA GeForce RTX 3090 24GB',
                'description' => 'GPU de gama alta de la serie 30. 24GB VRAM, excelente para gaming 4K, renderizado y creación de contenido profesional.',
                'stock' => 12,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx3090.png',
                'price_cents' => 99999, // 999.99€
            ],
            [
                'name' => 'AMD Radeon RX 6800 XT 16GB',
                'description' => 'GPU RDNA 2 de gama alta con 16GB VRAM. Excelente para gaming 1440p y 4K, competencia directa de RTX 3080.',
                'stock' => 25,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx6800xt.jpg',
                'price_cents' => 59999, // 599.99€
            ],
            [
                'name' => 'NVIDIA GeForce RTX 3070 Ti 8GB',
                'description' => 'GPU de gama media-alta de la serie 30. 8GB VRAM, Ray Tracing, DLSS 2.0. Perfecta para gaming 1440p y 4K.',
                'stock' => 28,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx3070ti.webp',
                'price_cents' => 54999, // 549.99€
            ],
            [
                'name' => 'AMD Radeon RX 6700 XT 12GB',
                'description' => 'GPU RDNA 2 para gaming 1440p. 12GB VRAM, excelente rendimiento en juegos AAA y streaming simultáneo.',
                'stock' => 40,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx6700xt.jpg',
                'price_cents' => 39999, // 399.99€
            ],
            [
                'name' => 'NVIDIA GeForce RTX 3060 Ti 8GB',
                'description' => 'GPU popular de la serie 30. 8GB VRAM, Ray Tracing, DLSS 2.0. Excelente para gaming 1080p y 1440p.',
                'stock' => 58,
                'brand' => 'NVIDIA',
                'category' => 'GPU',
                'image_url' => '/images/products/rtx3060ti.png',
                'price_cents' => 37999, // 379.99€
            ],
            [
                'name' => 'AMD Radeon RX 7900 GRE 16GB',
                'description' => 'GPU RDNA 3 con 16GB VRAM. Versión especial con excelente relación rendimiento/precio para gaming 1440p y 4K.',
                'stock' => 32,
                'brand' => 'AMD',
                'category' => 'GPU',
                'image_url' => '/images/products/rx7900gre.jpg',
                'price_cents' => 57999, // 579.99€
            ],

            // RAM
            [
                'name' => 'Corsair Vengeance RGB Pro DDR4 32GB (2x16GB) 3600MHz',
                'description' => 'Memoria DDR4 con iluminación RGB personalizable. 32GB dual channel, 3600MHz, perfecta para builds gaming con estética.',
                'stock' => 50,
                'brand' => 'Corsair',
                'category' => 'RAM',
                'image_url' => '/images/products/corsair-vengeance-rgb-pro-32gb.png',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'G.Skill Trident Z Neo DDR4 32GB (2x16GB) 3600MHz',
                'description' => 'Memoria DDR4 optimizada para AMD Ryzen. 32GB dual channel, 3600MHz, RGB direccionable, compatible con EXPO.',
                'stock' => 42,
                'brand' => 'G.Skill',
                'category' => 'RAM',
                'image_url' => '/images/products/gskill-trident-z-neo-32gb.jpg',
                'price_cents' => 12499, // 124.99€
            ],
            [
                'name' => 'Kingston FURY Beast RGB DDR5 16GB (2x8GB) 6000MHz',
                'description' => 'Memoria DDR5 con RGB y alto rendimiento. 16GB dual channel, 6000MHz, diseño agresivo, perfecta para gaming.',
                'stock' => 55,
                'brand' => 'Kingston',
                'category' => 'RAM',
                'image_url' => '/images/products/kingston-fury-beast-rgb-ddr5-16gb.webp',
                'price_cents' => 8999, // 89.99€
            ],
            [
                'name' => 'TeamGroup T-Force Vulcan DDR4 16GB (2x8GB) 3200MHz',
                'description' => 'Memoria DDR4 económica sin RGB. 16GB dual channel, 3200MHz, diseño minimalista, ideal para builds de presupuesto.',
                'stock' => 68,
                'brand' => 'TeamGroup',
                'category' => 'RAM',
                'image_url' => '/images/products/teamgroup-vulcan-16gb.webp',
                'price_cents' => 5999, // 59.99€
            ],
            [
                'name' => 'ADATA XPG Spectrix D50 DDR4 16GB (2x8GB) 3600MHz RGB',
                'description' => 'Memoria DDR4 con RGB direccionable. 16GB dual channel, 3600MHz, diseño futurista, excelente para builds gaming.',
                'stock' => 48,
                'brand' => 'ADATA',
                'category' => 'RAM',
                'image_url' => '/images/products/adata-xpg-spectrix-d50-16gb.webp',
                'price_cents' => 7499, // 74.99€
            ],
            [
                'name' => 'Patriot Viper Steel DDR4 32GB (2x16GB) 3600MHz',
                'description' => 'Memoria DDR4 de alto rendimiento sin RGB. 32GB dual channel, 3600MHz, diseño metálico, perfecta para overclocking.',
                'stock' => 38,
                'brand' => 'Patriot',
                'category' => 'RAM',
                'image_url' => '/images/products/patriot-viper-steel-32gb.webp',
                'price_cents' => 10999, // 109.99€
            ],

            // Storage
            [
                'name' => 'Samsung 870 EVO 1TB SATA SSD',
                'description' => 'SSD SATA de alto rendimiento. 1TB, velocidades hasta 560 MB/s lectura, perfecto para actualizar desde HDD o almacenamiento secundario.',
                'stock' => 70,
                'brand' => 'Samsung',
                'category' => 'Storage',
                'image_url' => '/images/products/samsung-870-evo-1tb.webp',
                'price_cents' => 8999, // 89.99€
            ],
            [
                'name' => 'WD Black SN850 1TB NVMe PCIe 4.0',
                'description' => 'SSD NVMe gaming de Western Digital. 1TB, velocidades hasta 7000 MB/s lectura, optimizado para PlayStation 5 y PC gaming.',
                'stock' => 45,
                'brand' => 'Western Digital',
                'category' => 'Storage',
                'image_url' => '/images/products/wd-black-sn850-1tb.png',
                'price_cents' => 9999, // 99.99€
            ],
            [
                'name' => 'Crucial P5 1TB NVMe PCIe 3.0',
                'description' => 'SSD NVMe económico con buen rendimiento. 1TB, velocidades hasta 3400 MB/s lectura, ideal para gaming y productividad.',
                'stock' => 58,
                'brand' => 'Crucial',
                'category' => 'Storage',
                'image_url' => '/images/products/crucial-p5-1tb.webp',
                'price_cents' => 7999, // 79.99€
            ],
            [
                'name' => 'Seagate IronWolf 4TB HDD 7200RPM NAS',
                'description' => 'Disco duro NAS de 4TB para almacenamiento masivo. 7200 RPM, caché 256MB, optimizado para servidores y NAS. Garantía 3 años.',
                'stock' => 35,
                'brand' => 'Seagate',
                'category' => 'Storage',
                'image_url' => '/images/products/seagate-ironwolf-4tb.jpg',
                'price_cents' => 10999, // 109.99€
            ],
            [
                'name' => 'Kingston NV1 1TB NVMe PCIe 3.0',
                'description' => 'SSD NVMe económico con formato M.2. 1TB, velocidades hasta 2100 MB/s lectura, perfecto para builds de presupuesto.',
                'stock' => 62,
                'brand' => 'Kingston',
                'category' => 'Storage',
                'image_url' => '/images/products/kingston-nv1-1tb.webp',
                'price_cents' => 5999, // 59.99€
            ],
            [
                'name' => 'ADATA XPG SX8200 Pro 1TB NVMe PCIe 3.0',
                'description' => 'SSD NVMe de alto rendimiento. 1TB, velocidades hasta 3500 MB/s lectura, controlador SMI, excelente para gaming.',
                'stock' => 50,
                'brand' => 'ADATA',
                'category' => 'Storage',
                'image_url' => '/images/products/adata-xpg-sx8200pro-1tb.jpg',
                'price_cents' => 7499, // 74.99€
            ],

            // Motherboards
            [
                'name' => 'ASUS ROG STRIX Z790-E Gaming WiFi',
                'description' => 'Placa base Intel Z790 premium con WiFi 6E. Compatible con CPUs de 12ª, 13ª y 14ª gen, DDR5, PCIe 5.0. RGB Aura Sync.',
                'stock' => 22,
                'brand' => 'ASUS',
                'category' => 'Motherboard',
                'image_url' => '/images/products/asus-rog-strix-z790e.jpg',
                'price_cents' => 39999, // 399.99€
            ],
            [
                'name' => 'MSI B450 Tomahawk Max',
                'description' => 'Placa base AMD B450 popular y confiable. Compatible con Ryzen 5000, DDR4, PCIe 3.0. Excelente relación calidad-precio.',
                'stock' => 48,
                'brand' => 'MSI',
                'category' => 'Motherboard',
                'image_url' => '/images/products/msi-b450-tomahawk-max.png',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'Gigabyte X670E AORUS Master',
                'description' => 'Placa base AMD X670E premium. Compatible con Ryzen 7000, DDR5, PCIe 5.0, WiFi 6E. Excelente para builds high-end.',
                'stock' => 15,
                'brand' => 'Gigabyte',
                'category' => 'Motherboard',
                'image_url' => '/images/products/gigabyte-x670e-aorus-master.webp',
                'price_cents' => 44999, // 449.99€
            ],
            [
                'name' => 'ASRock B550M Pro4',
                'description' => 'Placa base AMD B550 micro-ATX económica. Compatible con Ryzen 5000, DDR4, PCIe 4.0. Perfecta para builds compactas.',
                'stock' => 55,
                'brand' => 'ASRock',
                'category' => 'Motherboard',
                'image_url' => '/images/products/asrock-b550m-pro4.webp',
                'price_cents' => 9999, // 99.99€
            ],
            [
                'name' => 'ASUS Prime B660M-A WiFi',
                'description' => 'Placa base Intel B660 micro-ATX con WiFi 6. Compatible con CPUs de 12ª y 13ª gen, DDR4, PCIe 4.0. Excelente relación calidad-precio.',
                'stock' => 42,
                'brand' => 'ASUS',
                'category' => 'Motherboard',
                'image_url' => '/images/products/asus-prime-b660m-a.webp',
                'price_cents' => 14999, // 149.99€
            ],
            [
                'name' => 'MSI MAG X670E Tomahawk WiFi',
                'description' => 'Placa base AMD X670E con WiFi 6E. Compatible con Ryzen 7000, DDR5, PCIe 5.0. Diseño militar TUF, excelente VRM.',
                'stock' => 28,
                'brand' => 'MSI',
                'category' => 'Motherboard',
                'image_url' => '/images/products/msi-mag-x670e-tomahawk.png',
                'price_cents' => 32999, // 329.99€
            ],

            // PSU
            [
                'name' => 'Corsair SF750 750W 80+ Platinum',
                'description' => 'Fuente modular SFX de 750W con certificación 80+ Platinum. Formato compacto, ideal para builds mini-ITX. Cables modulares.',
                'stock' => 30,
                'brand' => 'Corsair',
                'category' => 'PSU',
                'image_url' => '/images/products/corsair-sf750-750w.jpg',
                'price_cents' => 17999, // 179.99€
            ],
            [
                'name' => 'be quiet! Dark Power 13 850W 80+ Titanium',
                'description' => 'Fuente premium con certificación 80+ Titanium. 850W, máxima eficiencia, componentes de primera calidad, funcionamiento silencioso.',
                'stock' => 18,
                'brand' => 'be quiet!',
                'category' => 'PSU',
                'image_url' => '/images/products/bequiet-dark-power-13-850w.webp',
                'price_cents' => 21999, // 219.99€
            ],
            [
                'name' => 'Seasonic Focus GX-750 750W 80+ Gold',
                'description' => 'Fuente modular 750W con certificación 80+ Gold. Cables modulares, ventilador silencioso, protecciones completas. Garantía 10 años.',
                'stock' => 52,
                'brand' => 'Seasonic',
                'category' => 'PSU',
                'image_url' => '/images/products/seasonic-focus-gx750.jpg',
                'price_cents' => 11999, // 119.99€
            ],
            [
                'name' => 'Thermaltake Toughpower PF1 650W 80+ Platinum',
                'description' => 'Fuente modular 650W con certificación 80+ Platinum. Ventilador hidráulico, cables flat, diseño compacto. Excelente eficiencia.',
                'stock' => 35,
                'brand' => 'Thermaltake',
                'category' => 'PSU',
                'image_url' => '/images/products/thermaltake-pf1-650w.webp',
                'price_cents' => 13999, // 139.99€
            ],
            [
                'name' => 'Cooler Master MWE Gold 750W 80+ Gold V2',
                'description' => 'Fuente modular 750W con certificación 80+ Gold. Ventilador silencioso, cables modulares, protecciones completas. Excelente relación calidad-precio.',
                'stock' => 48,
                'brand' => 'Cooler Master',
                'category' => 'PSU',
                'image_url' => '/images/products/coolermaster-mwe-gold-750w-v2.webp',
                'price_cents' => 10999, // 109.99€
            ],

            // Cases
            [
                'name' => 'Lian Li O11 Dynamic Mini',
                'description' => 'Caja compacta con diseño de doble cámara. Cristal templado, soporte para refrigeración líquida, perfecta para builds mini-ITX y mATX.',
                'stock' => 32,
                'brand' => 'Lian Li',
                'category' => 'Case',
                'image_url' => '/images/products/lian-li-o11-dynamic-mini.webp',
                'price_cents' => 12999, // 129.99€
            ],
            [
                'name' => 'Fractal Design Define 7',
                'description' => 'Torre ATX silenciosa con diseño minimalista. Panel lateral de cristal, excelente gestión de cables, optimizada para silencio.',
                'stock' => 25,
                'brand' => 'Fractal Design',
                'category' => 'Case',
                'image_url' => '/images/products/fractal-define-7.webp',
                'price_cents' => 16999, // 169.99€
            ],
            [
                'name' => 'be quiet! Silent Base 802',
                'description' => 'Torre ATX premium con diseño silencioso. Paneles intercambiables (malla/cristal), excelente flujo de aire, construcción robusta.',
                'stock' => 20,
                'brand' => 'be quiet!',
                'category' => 'Case',
                'image_url' => '/images/products/bequiet-silent-base-802.jpg',
                'price_cents' => 18999, // 189.99€
            ],
            [
                'name' => 'Cooler Master MasterCase H500M',
                'description' => 'Torre ATX gaming con dos ventiladores de 200mm RGB. Panel frontal de malla, cristal templado, excelente flujo de aire.',
                'stock' => 28,
                'brand' => 'Cooler Master',
                'category' => 'Case',
                'image_url' => '/images/products/coolermaster-h500m.jpg',
                'price_cents' => 15999, // 159.99€
            ],
            [
                'name' => 'NZXT H9 Flow',
                'description' => 'Torre ATX con diseño de doble cámara mejorado. Panel frontal de malla, cristal templado, excelente flujo de aire y estética moderna.',
                'stock' => 35,
                'brand' => 'NZXT',
                'category' => 'Case',
                'image_url' => '/images/products/nzxt-h9-flow.jpg',
                'price_cents' => 17999, // 179.99€
            ],

            // Cooling
            [
                'name' => 'Noctua NH-D15S chromax.black',
                'description' => 'Disipador de aire dual-tower en versión negra. Un ventilador NF-A15, compatibilidad universal mejorada, rendimiento silencioso excepcional.',
                'stock' => 50,
                'brand' => 'Noctua',
                'category' => 'Cooling',
                'image_url' => '/images/products/noctua-nhd15s-chromax.jpg',
                'price_cents' => 9999, // 99.99€
            ],
            [
                'name' => 'be quiet! Dark Rock Slim',
                'description' => 'Disipador de torre única compacto. Perfil bajo, ventilador Silent Wings 3, TDP 180W. Perfecto para builds compactas.',
                'stock' => 45,
                'brand' => 'be quiet!',
                'category' => 'Cooling',
                'image_url' => '/images/products/bequiet-dark-rock-slim.jpg',
                'price_cents' => 5999, // 59.99€
            ],
            [
                'name' => 'NZXT Kraken Z73 360mm AIO RGB',
                'description' => 'Refrigeración líquida AIO de 360mm con pantalla LCD personalizable. RGB integrado, bomba mejorada, excelente rendimiento térmico.',
                'stock' => 22,
                'brand' => 'NZXT',
                'category' => 'Cooling',
                'image_url' => '/images/products/nzxt-kraken-z73.jpg',
                'price_cents' => 24999, // 249.99€
            ],
            [
                'name' => 'EK-AIO Basic 240mm',
                'description' => 'Refrigeración líquida AIO de 240mm sin RGB. Diseño minimalista, excelente rendimiento, bomba de alta calidad. Perfecto para builds discretas.',
                'stock' => 38,
                'brand' => 'EKWB',
                'category' => 'Cooling',
                'image_url' => '/images/products/ek-aio-basic-240.webp',
                'price_cents' => 9999, // 99.99€
            ],

            // Peripherals
            [
                'name' => 'Teclado Logitech G915 TKL Wireless',
                'description' => 'Teclado mecánico inalámbrico TKL con switches GL. RGB LIGHTSYNC, batería 30 horas, diseño ultra-delgado. Perfecto para gaming y productividad.',
                'stock' => 30,
                'brand' => 'Logitech',
                'category' => 'Peripherals',
                'image_url' => '/images/products/logitech-g915-tkl.jpg',
                'price_cents' => 19999, // 199.99€
            ],
            [
                'name' => 'Ratón Razer Viper V2 Pro',
                'description' => 'Ratón gaming inalámbrico ultraligero. Sensor Focus Pro 30K, 58 gramos, batería 80 horas. Perfecto para esports y gaming competitivo.',
                'stock' => 42,
                'brand' => 'Razer',
                'category' => 'Peripherals',
                'image_url' => '/images/products/razer-viper-v2-pro.jpg',
                'price_cents' => 14999, // 149.99€
            ],
            [
                'name' => 'Ratón SteelSeries Rival 5',
                'description' => 'Ratón gaming con 9 botones programables. Sensor TrueMove Air, RGB PrismSync, diseño ergonómico. Perfecto para gaming y productividad.',
                'stock' => 38,
                'brand' => 'SteelSeries',
                'category' => 'Peripherals',
                'image_url' => '/images/products/steelseries-rival-5.webp',
                'price_cents' => 6999, // 69.99€
            ],
            [
                'name' => 'Auriculares HyperX Cloud Alpha Wireless',
                'description' => 'Auriculares gaming inalámbricos con batería de 300 horas. Sonido estéreo de alta calidad, micrófono desmontable, comodidad extrema.',
                'stock' => 28,
                'brand' => 'HyperX',
                'category' => 'Peripherals',
                'image_url' => '/images/products/hyperx-cloud-alpha-wireless.webp',
                'price_cents' => 19999, // 199.99€
            ],

            // Monitors
            [
                'name' => 'ASUS ROG Swift PG279QM 27" 1440p 240Hz',
                'description' => 'Monitor gaming premium de 27 pulgadas WQHD. 240Hz, 1ms GTG, G-Sync, HDR400, panel IPS. Máximo rendimiento para gaming competitivo.',
                'stock' => 15,
                'brand' => 'ASUS',
                'category' => 'Monitor',
                'image_url' => '/images/products/asus-rog-pg279qm.webp',
                'price_cents' => 69999, // 699.99€
            ],
            [
                'name' => 'Samsung Odyssey G9 49" 1440p 240Hz Curved',
                'description' => 'Monitor gaming ultrawide curvo 1000R de 49 pulgadas. 240Hz, 1ms, QLED, HDR1000. Inmersión total para gaming y productividad.',
                'stock' => 10,
                'brand' => 'Samsung',
                'category' => 'Monitor',
                'image_url' => '/images/products/samsung-odyssey-g9.webp',
                'price_cents' => 99999, // 999.99€
            ],
        ];

        // Eliminar productos antiguos de periféricos que no tienen prefijo
        // para evitar duplicados al cambiar los nombres
        $oldPeripheralNames = [
            'Logitech G Pro X Superlight',
            'Razer BlackWidow V3 Mechanical Keyboard',
            'Corsair K70 RGB MK.2 Cherry MX Red',
            'SteelSeries Apex Pro TKL',
            'Razer DeathAdder V3 Pro',
            'Logitech G502 X Plus',
            'HyperX Alloy Elite 2',
            'Corsair Scimitar RGB Elite',
            'Logitech G915 TKL Wireless',
            'Razer Viper V2 Pro',
            'SteelSeries Rival 5',
            'HyperX Cloud Alpha Wireless',
        ];
        
        Product::where('category', 'Peripherals')
            ->whereIn('name', $oldPeripheralNames)
            ->delete();

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
