Bagian 5: Studi Kasus - Blog Application
5.1 Struktur Database Blog
Dalam studi kasus ini, kita akan membuat aplikasi blog dengan tabel-tabel berikut:
Tabel Fungsi
users Menyimpan data penulis/author
posts Menyimpan artikel blog
comments Menyimpan komentar pada artikel
5.2 Step-by-Step Implementation
STEP 1: Create Users Table
php artisan make:model User -m
# Edit migration file:
Schema::create('users', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('email')->unique();
$table->string('password');
$table->timestamps();
});
STEP 2: Create Posts Table
php artisan make:model Post -m
# Edit migration file:
Schema::create('posts', function (Blueprint $table) {
$table->id();
$table->string('title');
$table->text('content');
$table->foreignId('user_id')->constrained('users');
$table->timestamps();
});
STEP 3: Create Comments Table
php artisan make:model Comment -m
# Edit migration file:
Schema::create('comments', function (Blueprint $table) {
$table->id();
$table->text('content');
$table->foreignId('user_id')->constrained('users');
$table->foreignId('post_id')->constrained('posts');
$table->timestamps();
});
STEP 4: Run Migration
$ php artisan migrate
5.3 Eloquent Examples dalam Controller
// CREATE
$post = Post::create(['title' => 'Judul', 'user_id' => 1]);
// READ
$post = Post::find(1);
$posts = Post::where('user_id', 1)->get();
// UPDATE
$post->update(['title' => 'Judul Baru']);
// DELETE
$post->delete();
5.4 Query Builder Examples
// Join dengan user
DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')->select('posts.*', 'users.name as author')->orderBy('posts.created_at', 'desc')->get();
// Posts dari user tertentu
DB::table('posts')->where('user_id', 1)->get();
// Latest 5 posts
DB::table('posts')->orderBy('created_at', 'desc')->limit(5)->get();
