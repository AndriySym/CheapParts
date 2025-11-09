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
                'name' => 'Logitech G Pro X Superlight',
                'description' => 'Ratón gaming inalámbrico ultraligero. Sensor HERO 25K, 63 gramos, batería 70 horas. Perfecto para esports.',
                'stock' => 40,
                'brand' => 'Logitech',
                'category' => 'Peripherals',
                'image_url' => '/images/products/logitech-gpro-superlight.jpg',
                'price_cents' => 13999, // 139.99€
            ],
            [
                'name' => 'Razer BlackWidow V3 Mechanical Keyboard',
                'description' => 'Teclado mecánico gaming con switches Razer Green. RGB Chroma, reposamuñecas ergonómico, construcción premium.',
                'stock' => 35,
                'brand' => 'Razer',
                'category' => 'Peripherals',
                'image_url' => '/images/products/razer-blackwidow-v3.jpg',
                'price_cents' => 14999, // 149.99€
            ],
            [
                'name' => 'Corsair K70 RGB MK.2 Cherry MX Red',
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
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
