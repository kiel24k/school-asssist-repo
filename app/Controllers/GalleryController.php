<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gallery;
use CodeIgniter\HTTP\ResponseInterface;

class GalleryController extends BaseController
{
    public function index()
    {
        $gallery = new Gallery();
        $data['data'] = $gallery->findAll();
        return view("gallery/index", $data);
    }
    public function create_view()
    {
        return view("gallery/create");
    }
    public function create()
    {

        $validation = \Config\Services::validation();
        if (!$this->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'mime_in[image,image/jpg,image/jpeg,image/gif,image/png] |max_size[image,3000]'
        ])) {
            $errors = array(
                'error' => $validation->listErrors()
            );
            session()->setFlashdata($errors);
            return redirect()->back();
        } else {
            $Gallery = new Gallery();
            $file = $this->request->getFile('image');
            if ($file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move('uploads/', $imageName);
            }
            $data = [
                'name'  => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'image' => $imageName
            ];
            $Gallery->save($data);
            return redirect()->to('/')->with('status', 'Product Data saved');
        }
    }
    public function delete($id)
    {
        $gallery = new Gallery();
        $gallery->delete($id);
        return redirect()->to('/')->with('status', 'Delete Successful');
    }

    public function update_view($id)
    {
        $gallery = new Gallery();
        $data['data'] = $gallery->find($id);
        return view('gallery/update', $data);
    }
    public function update($id)
    {
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'mime_in[image,image/jpg,image/jpeg,image/gif,image/png] |max_size[image,3000]'
        ])) {
            $errors = array(
                'error' => $validation->listErrors()
            );
            session()->setFlashdata($errors);
            return redirect()->back();
        } else {
            $realestate = new Gallery();
            $datas = $realestate->find($id);
            $file = $this->request->getFile('image');
            $old_image = $datas['image'];

            if ($file->isValid() && !$file->hasMoved()) {

                if (file_exists("uploads/" . $old_image)) {
                    unlink("uploads/" . $old_image);
                }
                $imageName = $file->getRandomName();
                $file->move('uploads/', $imageName);
            } else {
                $imageName = $old_image;
            }
            $data = [
                'name'  => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'image' => $imageName
            ];
            $realestate->update($id, $data);
            return redirect()->to('/')->with('status', 'Product Data updated');
        }
    }
    public function download($image)
    {
        return $this->response->download('uploads/' . $image, null);
    }
}
