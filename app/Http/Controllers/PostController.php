<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // Récupérer la liste des utilisateurs
        $authors = User::all();

        // Récupérer la liste des catégories
        $categories = Category::all();
        return view('posts.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate($this->validationRules());

        // Récupérer le nom de l'image uploadée
        // puis le déplacer dans le dossier storage/app/posts
        $image = Storage::disk('public')->put('posts', $request->file('image'));

        // Créer une nouvelle instance de Post
        $newPost = new Post();
        $newPost->title = $request->title;
        $newPost->content = $request->input('content');
        $newPost->image = $image; // Enregistrer le nom de l'image
        $newPost->user_id = $request->input('user_id'); // Récupérer l'ID de l'auteur   
        $newPost->category_id = $request->input('category_id'); // Récupérer l'ID de la catégorie
        
        // Sauvegarder le post
        $newPost->save();  
        
        // Rediriger vers la liste des posts
        
        return redirect()->route('posts.show', $newPost->id)->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('category', 'user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer le post à éditer
        $post = Post::findOrFail($id);
        // Récupérer la liste des utilisateurs
        $authors = User::all();
        // Récupérer la liste des catégories
        $categories = Category::all();
        // Passer le post, les utilisateurs et les catégories à la vue 
        // pour pré-remplir le formulaire d'édition 
        return view('posts.edit', compact('post', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate($this->validationRules());
        // Récupérer le post à mettre à jour
        $post = Post::findOrFail($id);
        // Vérifier si une nouvelle image a été uploadée    
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image from storage
            if (Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            // Récupérer le nom de la nouvelle image uploadée
            // puis le déplacer dans le dossier storage/app/posts
            $newImage = Storage::disk('public')->put('posts', $request->file('image'));
            // Mettre à jour le nom de l'image dans le post
            $post->image = $newImage;

            $post->title = $request->title;
            $post->content = $request->input('content');
            $post->user_id = $request->input('user_id'); // Récupérer l'ID de l'auteur  
            $post->category_id = $request->input('category_id'); // Récupérer l'ID de la catégorie
            // Sauvegarder le post
            $post->save();
            // Rediriger vers la liste des posts
            return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully.');    
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validation rules for the post creation form.
     */
    public function validationRules(){
        return [
            'title' => 'required|string|min:5',
            'content' => 'required|string|min:10',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB max
        ];
    }
}
