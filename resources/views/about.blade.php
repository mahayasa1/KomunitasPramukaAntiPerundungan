@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

<section class="pt-40 pb-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-4xl font-extrabold text-cyan-600 mb-6 text-center">
            Tentang Komunitas Pramuka Anti Perundungan
        </h1>

        <p class="text-gray-700 leading-relaxed text-lg mb-6 text-justify">
            Komunitas Pramuka Anti Perundungan adalah sebuah gerakan sosial yang dibentuk untuk menciptakan
            lingkungan pramuka yang aman, nyaman, dan bebas dari segala bentuk perundungan.
            Kami percaya bahwa setiap anggota memiliki hak untuk berkembang dengan percaya diri tanpa rasa takut.
        </p>

        <p class="text-gray-700 leading-relaxed text-lg mb-6 text-justify">
            Melalui berbagai kegiatan edukatif, kampanye, dan pelatihan, kami berkomitmen untuk meningkatkan
            kesadaran mengenai pentingnya empati, solidaritas, dan keberanian untuk melawan tindakan perundungan.
        </p>

        <div class="grid md:grid-cols-3 gap-8 mt-12">

            <div class="bg-cyan-500/10 rounded-xl p-6 shadow">
                <h3 class="text-xl font-bold text-cyan-600 mb-3">Visi</h3>
                <p class="text-gray-700">Mewujudkan generasi pramuka yang bebas dari perundungan dan saling menghargai.</p>
            </div>

            <div class="bg-cyan-500/10 rounded-xl p-6 shadow">
                <h3 class="text-xl font-bold text-cyan-600 mb-3">Misi</h3>
                <ul class="text-gray-700 list-disc ml-5">
                    <li>Mengadakan edukasi anti-bullying.</li>
                    <li>Menciptakan lingkungan yang inklusif.</li>
                    <li>Mendorong keberanian untuk bersuara.</li>
                </ul>
            </div>

            <div class="bg-cyan-500/10 rounded-xl p-6 shadow">
                <h3 class="text-xl font-bold text-cyan-600 mb-3">Tujuan</h3>
                <p class="text-gray-700">Memberikan pendampingan dan perlindungan bagi anggota pramuka dari tindakan negatif.</p>
            </div>

        </div>
    </div>
</section>

@endsection
