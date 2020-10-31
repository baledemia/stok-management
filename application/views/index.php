<style>
	.event-entry .desc {
		padding-left: 95px
	}
</style>
<div id="colorlib-services">
	<div class="container">
		<div class="row">
			<div class="col-md-12 services-wrap">
				<div class="row">
					<?php foreach($categories as $category) : ?>
					<div class="col-md-2 col-sm-6 text-center animate-box">
						<a href="#" class="services">
							<span class="icon">
								<i class="<?=$category->icon?>"></i>
							</span>
							<div class="desc">
								<?php $text = explode(' ', $category->category_name) ?>
								<h3><?=$text[0]?> <br> <?=$text[1]?></h3>
							</div>
						</a>
					</div>
					<?php endforeach ?>
					<!-- <div class="col-md-2 col-sm-6 text-center animate-box">
						<a href="services.html" class="services">
							<span class="icon">
								<i class="flaticon-smartphone"></i>
							</span>
							<div class="desc">
								<h3>Mobile <br>Apps</h3>
							</div>
						</a>
					</div> -->

					<div class="col-md-2 col-sm-6 text-center animate-box">
						<a href="#" class="services">
							<span class="icon">
								<i class="flaticon-laboratory"></i>
							</span>
							<div class="desc">
								<h3>Analisis <br>Data</h3>
							</div>
						</a>
					</div>
					<div class="col-md-2 col-sm-6 text-center animate-box">
						<a href="#" class="services">
							<span class="icon">
								<i class="flaticon-computer-graphic"></i>
							</span>
							<div class="desc">
								<h3>Graphic <br>Design</h3>
							</div>
						</a>
					</div>
					<div class="col-md-2 col-sm-6 text-center animate-box">
						<a href="#" class="services">
							<span class="icon">
								<i class="flaticon-video-player"></i>
							</span>
							<div class="desc">
								<h3>Digital <br>Marketing</h3>
							</div>
						</a>
					</div>
					<div class="col-md-2 col-sm-6 text-center animate-box">
						<a href="#" class="services">
							<span class="icon">
								<i class="flaticon-layers"></i>
							</span>
							<div class="desc">
								<h3>User <br>Interface</h3>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-12 text-center animate-box">
				<p><a href="https://vimeo.com/channels/staffpicks/93951774" class="btn btn-primary btn-outline btn-lg btn-discover popup-vimeo"><span class="icon"><i class="icon-play3"></i></span> Suasana Belajar</a></p>
			</div>
		</div>
	</div>
</div>

<!-- <div class="colorlib-classes">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 colorlib-heading center-heading text-center animate-box">
				<h1 class="heading-big">Pilihan Belajar</h1>
				<h2>Kelas Online Populer</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 animate-box">
				<div class="owl-carousel">
					<div class="item">
						<div class="classes">
							<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-1.jpg);">
							</div>
							<div class="wrap">
								<div class="desc">
									<span class="teacher">David Clarson</span>
									<h3><a href="<?=site_url('course/show') ?>">Membuat Rest API dengan Python</a></h3>
								</div>
								<div class="pricing">
									<p><span class="price">Menengah</span> <span class="price old-price">1 h 45 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="classes">
							<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-2.jpg);">
							</div>
							<div class="wrap">
								<div class="desc">
									<span class="teacher">Ayu Minati</span>
									<h3><a href="<?=site_url('course/show') ?>">Pelajari Dasar-Dasar Photoshop</a></h3>
								</div>
								<div class="pricing">
									<p><span class="price">Basic</span> <span class="price old-price">3 h 19 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="classes">
							<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-3.jpg);">
							</div>
							<div class="wrap">
								<div class="desc">
									<span class="teacher">Erik Clarson</span>
									<h3><a href="<?=site_url('course/show') ?>">Implementasi CRUD pada Laravel 5.8</a></h3>
								</div>
								<div class="pricing">
									<p><span class="price">Basic</span> <span class="price old-price">2 h 41 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="classes">
							<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-4.jpg);">
							</div>
							<div class="wrap">
								<div class="desc">
									<span class="teacher">Gary Clarson</span>
									<h3><a href="<?=site_url('course/show') ?>">Full-Stack Web Designer</a></h3>
								</div>
								<div class="pricing">
									<p><span class="price">Menengah</span> <span class="price old-price">1 h 58 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="classes">
							<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-5.jpg);">
							</div>
							<div class="wrap">
								<div class="desc">
									<span class="teacher">Frisky Wahyudi</span>
									<h3><a href="<?=site_url('course/show') ?>">Belajar Database Dengan Room di Android</a></h3>
								</div>
								<div class="pricing">
									<p><span class="price">Sulit</span> <span class="price old-price">2 h 1 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div> -->

<div id="colorlib-counter" class="colorlib-counters">
	<div class="container">
		<div class="col-md-7">
			<div class="about-desc">
				<div class="about-img-1 animate-box" style="background-image: url(<?=base_url('assets/frontend') ?>/images/about-img-2.jpg);"></div>
				<div class="about-img-2 animate-box" style="background-image: url(<?=base_url('assets/frontend') ?>/images/about-img-1.jpg);"></div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="row">
				<div class="col-md-12 colorlib-heading animate-box">
					<h1 class="heading-big">Siapa Kita?</h1>
					<h2>Kenapa Belajar Disini?</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 animate-box">
					<p><strong>Proses Belajar Lebih Efektif Dengan Mengakses Semua Kelas Dimana Saja dan Kapan Saja</strong></p>
					<p>Mulai dari Pelajar, Mahasiswa, Dosen, Staff, Anak IT atau bukan. Semuanya bisa membuat
					satu aplikasi yang bisa bermanfaat untuk ratusan juta orang</p>
				</div>
				<div class="col-md-6 col-sm-6 animate-box">
					<div class="counter-entry">
						<div class="desc">
							<span class="colorlib-counter js-counter" data-from="0" data-to="1539" data-speed="5000" data-refresh-interval="50"></span>
							<span class="colorlib-counter-label">Kelas</span>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 animate-box">
					<div class="counter-entry">
						<div class="desc">
							<span class="colorlib-counter js-counter" data-from="0" data-to="3653" data-speed="5000" data-refresh-interval="50"></span>
							<span class="colorlib-counter-label">Murid</span>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 animate-box">
					<div class="counter-entry">
						<div class="desc">
							<span class="colorlib-counter js-counter" data-from="0" data-to="2300" data-speed="5000" data-refresh-interval="50"></span>
							<span class="colorlib-counter-label">Aktivitas</span>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 animate-box">
					<div class="counter-entry">
						<div class="desc">
							<span class="colorlib-counter js-counter" data-from="0" data-to="200" data-speed="5000" data-refresh-interval="50"></span>
							<span class="colorlib-counter-label">Karya</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="colorlib-testimony" class="testimony-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/img_bg_2.jpg); margin-bottom: 4em;" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 center-heading text-center colorlib-heading animate-box">
				<h1 class="heading-big">Usaha Ada Hasil</h1>
				<h2>Apa Kata Mereka?</h2>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="testimony-flex">
				    <?php $no = 1; if($testimoni) : foreach($testimoni as $tesi) : ?>
					<div class="one-fifth animate-box">
						<span class="icon"><i class="icon-quotes-left"></i></span>
						<div class="testimony-wrap">
							<blockquote>
								<?=$tesi->content?>
							</blockquote>
							<div class="desc">
								<div class="figure-img" style="background-image: url(<?=base_url('assets/backend/img/testimoni/'.$tesi->avatar) ?>);"></div>
								<h3><?=$tesi->name?></h3>
							</div>
						</div>
					</div>
					<?php $no++; endforeach; else: ?>
        			<div class="one-fifth animate-box" style="width: 100%">
        			    <span class="icon"><i class="icon-quotes-left"></i></span>
    						<div class="testimony-wrap">
            				<blockquote><p>Testimoni Belum Ada. </p></blockquote>
        				</div>
        			</div>
        			<?php endif ?>
					<!--<div class="one-fifth animate-box">-->
					<!--	<span class="icon"><i class="icon-quotes-left"></i></span>-->
					<!--	<div class="testimony-wrap">-->
					<!--		<blockquote>-->
					<!--			<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>-->
					<!--		</blockquote>-->
					<!--		<div class="desc">-->
					<!--			<div class="figure-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/person2.jpg);"></div>-->
					<!--			<h3>Dave Henderson</h3>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
					<!--<div class="one-fifth animate-box">-->
					<!--	<span class="icon"><i class="icon-quotes-left"></i></span>-->
					<!--	<div class="testimony-wrap">-->
					<!--		<blockquote>-->
					<!--			<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>-->
					<!--		</blockquote>-->
					<!--		<div class="desc">-->
					<!--			<div class="figure-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/person3.jpg);"></div>-->
					<!--			<h3>Dave Henderson</h3>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
					<!--<div class="one-fifth animate-box">-->
					<!--	<span class="icon"><i class="icon-quotes-left"></i></span>-->
					<!--	<div class="testimony-wrap">-->
					<!--		<blockquote>-->
					<!--			<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove</p>-->
					<!--		</blockquote>-->
					<!--		<div class="desc">-->
					<!--			<div class="figure-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/person1.jpg);"></div>-->
					<!--			<h3>Dave Henderson</h3>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
					<!--<div class="one-fifth animate-box">-->
					<!--	<span class="icon"><i class="icon-quotes-left"></i></span>-->
					<!--	<div class="testimony-wrap">-->
					<!--		<blockquote>-->
					<!--			<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>-->
					<!--		</blockquote>-->
					<!--		<div class="desc">-->
					<!--			<div class="figure-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/person1.jpg);"></div>-->
					<!--			<h3>Dave Henderson</h3>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <div class="colorlib-trainers">
	<div class="container">
		<div class="row">
			<div class="col-md-12 colorlib-heading center-heading text-center animate-box">
				<h1 class="heading-big">Our Instructor</h1>
				<h2>Our Instructor</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 animate-box">
				<div class="trainers-entry">
					<div class="desc">
						<h3>Olivia Young</h3>
						<span>instructor</span>
					</div>
					<div class="trainer-img" style="background-image: url(images/person1.jpg)"></div>
				</div>
			</div>

			<div class="col-md-3 col-sm-3 animate-box">
				<div class="trainers-entry">
					<div class="desc">
						<h3>Daniel Anderson</h3>
						<span>Instructor</span>
					</div>
					<div class="trainer-img" style="background-image: url(images/person2.jpg)"></div>
				</div>
			</div>

			<div class="col-md-3 col-sm-3 animate-box">
				<div class="trainers-entry">
					<div class="desc">
						<h3>David Brook</h3>
						<span>Instructor</span>
					</div>
					<div class="trainer-img" style="background-image: url(images/person3.jpg)"></div>
				</div>
			</div>

			<div class="col-md-3 col-sm-3 animate-box">
				<div class="trainers-entry">
					<div class="desc">
						<h3>Brigeth Smith</h3>
						<span>instructor</span>
					</div>
					<div class="trainer-img" style="background-image: url(images/person4.jpg)"></div>
				</div>
			</div>
		</div>
	</div>
</div> -->

<div class="colorlib-classes">
	<div class="container">
		<div class="row">
			<div class="col-md-12 colorlib-heading center-heading text-center animate-box">
				<h1 class="heading-big">Daftar Kelas</h1>
				<h2>Belajar Online Disini</h2>
			</div>
		</div>
		<div class="row">
			<?php $no = 1; if($courses) : foreach($courses as $course) : ?>
			<?php $this->db->select('name') ?>
			<?php $profile = $this->db->get_where('trainers', array('id' => $course->trainer_id))->row() ?>
			<div class="col-md-4 animate-box">
				<div class="classes">
					<div class="classes-img" style="background-image: url(<?=base_url('assets/backend/tmp/course/'.$course->cover) ?>);">
					</div>
					<div class="wrap">
						<div class="desc">
							<span class="teacher"><?=$profile->name?></span>
							<h3><a href="<?=site_url('course/show/' .$course->slug) ?>"><?=$course->title?></a></h3>
						</div>
						<div class="pricing">
							<p><span class="price"><?= ucfirst($course->level) ?></span> <span class="price old-price"><?=$course->duration?></span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
						</div>
					</div>
				</div>
			</div>
			<?php $no++; endforeach; else: ?>
			<div class="col-md-12">
				<div class="alert alert-danger">Maaf, Kelas Premium Belum Tersedia. </div>
			</div>
			<?php endif ?>

			<!-- <div class="col-md-4 animate-box">
				<div class="classes">
					<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-2.jpg);">
					</div>
					<div class="wrap">
						<div class="desc">
							<span class="teacher">Noah Henderson</span>
							<h3><a href="<?=site_url('course/show') ?>">Developing Mobile Apps Using Ruby on Rails</a></h3>
						</div>
						<div class="pricing">
							<p><span class="price">Sulit</span> <span class="price old-price">3 h 19 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 animate-box">
				<div class="classes">
					<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-3.jpg);">
					</div>
					<div class="wrap">
						<div class="desc">
							<span class="teacher">David Clarson</span>
							<h3><a href="<?=site_url('course/show') ?>">Developing Mobile Apps Using Ruby on Rails</a></h3>
						</div>
						<div class="pricing">
							<p><span class="price">Menengah</span> <span class="price old-price">3 h 19 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 animate-box">
				<div class="classes">
					<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-4.jpg);">
					</div>
					<div class="wrap">
						<div class="desc">
							<span class="teacher">Noah Henderson</span>
							<h3><a href="<?=site_url('course/show') ?>">Developing Mobile Apps Using Ruby on Rails</a></h3>
						</div>
						<div class="pricing">
							<p><span class="price">Sulit</span> <span class="price old-price">3 h 19 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 animate-box">
				<div class="classes">
					<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-5.jpg);">
					</div>
					<div class="wrap">
						<div class="desc">
							<span class="teacher">David Clarson</span>
							<h3><a href="<?=site_url('course/show') ?>">Developing Mobile Apps Using Ruby on Rails</a></h3>
						</div>
						<div class="pricing">
							<p><span class="price">Pemula</span> <span class="price old-price">3 h 19 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 animate-box">
				<div class="classes">
					<div class="classes-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/classes-6.jpg);">
					</div>
					<div class="wrap">
						<div class="desc">
							<span class="teacher">David Clarson</span>
							<h3><a href="<?=site_url('course/show') ?>">Developing Mobile Apps Using Ruby on Rails</a></h3>
						</div>
						<div class="pricing">
							<p><span class="price">Pemula</span> <span class="price old-price">3 h 19 m</span> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>	
</div>

<div class="colorlib-event">
	<div class="container">
		<div class="row">
			<div class="col-md-5 row-pb-md">
				<div class="row">
					<div class="col-md-12 colorlib-heading animate-box">
						<h1 class="heading-big">Acara</h1>
						<h2>Program Kita</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="event-entry animate-box">
							<div class="desc">
								<p class="meta"><span class="day">Coming</span><span class="month">Soon</span></p>
								<p class="organizer"><span>Didampingi oleh:</span> <span>Praktisi Handal</span></p>
								<h2><a href="<?=site_url('course-online') ?>">Belajar Online Bersama Banyak Teman</a></h2>
							</div>
							<div class="location">
								<span class="icon"><i class="icon-headphones"></i></span>
								<p>Pilih sesuai materi yang ingin dipelajari dan belajar dirumah berdasarkan silabus pertemuan</p>
							</div>
						</div>
						<div class="event-entry animate-box">
							<div class="desc">
								<p class="meta"><span class="day">Coming</span><span class="month">Soon</span></p>
								<p class="organizer"><span>LIVE :</span> <span>Webinar</span></p>
								<h2><a href="#">Duduk Santai Sambil Berdiskusi</a></h2>
							</div>
							<div class="location">
								<span class="icon"><i class="icon-bubble"></i></span>
								<p>Menyimak dengan santai materi yang disampaikan</p>
							</div>
						</div>
						<div class="event-entry animate-box">
							<div class="desc">
								<p class="meta"><span class="day">Coming</span><span class="month">Soon</span></p>
								<p class="organizer"><span>Pelatihan :</span> <span>Bootcamp</span></p>
								<h2><a href="#">Semua Bisa Ikut Termasuk Kamu</a></h2>
							</div>
							<div class="location">
								<span class="icon"><i class="icon-stats-dots"></i></span>
								<p>Kelas terbuka buat siapa saja yang ingin belajar secara intensif berdasarkan kurikulum yang telah disiapkan</p>
							</div>
						</div>
						<div class="event-entry animate-box">
							<div class="desc">
								<p class="meta"><span class="day">Coming</span><span class="month">Soon</span></p>
								<p class="organizer"><span>Menjadi </span> <span>Member Berlangganan</span></p>
								<h2><a href="#">Belajar Mulai Dari Sekarang</a></h2>
							</div>
							<div class="location">
								<span class="icon"><i class="icon-mobile"></i></span>
								<p>Akses semua materinya kapan pun dimana pun tanpa batas</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-7 row-pb-md">
				<div class="row">
					<div class="col-md-12 colorlib-heading animate-box">
						<h1 class="heading-big">Blog Kita</h1>
						<h2>Artikel Hari Ini</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php $no = 1; if($posts): foreach($posts as $post) : ?>
						<?php $date = date('d F Y H:i:s', strtotime($post->created_at)); ?>
						<div class="block-21 d-flex animate-box">
	            <a href="<?=site_url('blog/show/' .$post->slug) ?>" class="blog-img" 
	            	style="background-image: url(<?=base_url('assets/frontend') ?>/images/blog-<?=$no?>.jpg);"></a>
	            <div class="text">
	               <h3 class="heading"><a href="<?=site_url('blog/show/' .$post->slug) ?>"> <?=$post->title?></a></h3>
	               <p><?=$post->excerpt?></p>
	               <div class="meta">
	                  <div><a href="#"><span class="icon-calendar"></span> <?=$date?></a></div>
	                  <div><a href="#"><span class="icon-user2"></span> Admin</a></div>
	                  <div><a href="#"><span class="icon-chat"></span> 0</a></div>
	               </div>
	            </div>
		        </div>
		        <?php $no++; endforeach; else: ?>
						<div class="">
							<div class="alert alert-danger">Artikel Saat Ini Masih Kosong.</div>
						</div>
		      	<?php endif ?>

						<!-- <div class="block-21 d-flex animate-box">
						  <a href="<?=site_url('blog/show') ?>" class="blog-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/blog-2.jpg);"></a>
						  <div class="text">
						     <h3 class="heading"><a href="<?=site_url('blog/show') ?>"> Bagaimana menambah anggota komunitas?</a></h3>
						     <p>ven the all-powerful Pointing has no control about the blind texts it is an almost</p>
						     <div class="meta">
						        <div><a href="#"><span class="icon-calendar"></span> May 29, 2018</a></div>
						        <div><a href="#"><span class="icon-user2"></span> Admin</a></div>
						        <div><a href="#"><span class="icon-chat"></span> 19</a></div>
						     </div>
						  </div>
						</div>
						
						<div class="block-21 d-flex animate-box">
						  <a href="<?=site_url('blog/show') ?>" class="blog-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/blog-3.jpg);"></a>
						  <div class="text">
						     <h3 class="heading"><a href="<?=site_url('blog/show') ?>"> Bahasa program apa yang harus saya pelajari?</a></h3>
						     <p>ven the all-powerful Pointing has no control about the blind texts it is an almost</p>
						     <div class="meta">
						        <div><a href="#"><span class="icon-calendar"></span> May 29, 2018</a></div>
						        <div><a href="#"><span class="icon-user2"></span> Admin</a></div>
						        <div><a href="#"><span class="icon-chat"></span> 19</a></div>
						     </div>
						  </div>
						</div>
						
						<div class="block-21 d-flex animate-box">
						  <a href="<?=site_url('blog/show') ?>" class="blog-img" style="background-image: url(<?=base_url('assets/frontend') ?>/images/blog-4.jpg);"></a>
						  <div class="text">
						     <h3 class="heading"><a href="<?=site_url('blog/show') ?>"> Perempuan yang menjadi panutan di dunia teknologi</a></h3>
						     <p>ven the all-powerful Pointing has no control about the blind texts it is an almost</p>
						     <div class="meta">
						        <div><a href="#"><span class="icon-calendar"></span> May 29, 2018</a></div>
						        <div><a href="#"><span class="icon-user2"></span> Admin</a></div>
						        <div><a href="#"><span class="icon-chat"></span> 19</a></div>
						     </div>
						  </div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



