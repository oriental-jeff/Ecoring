<?php



namespace App\Http\Controllers\Backend;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\Model\Products;




class TrashController extends Controller

{





    public function index()
    {

        $this->authorize('access trash');

        //trash model tolower

        $user = User::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        $trash['user'] = $user;

        $products = Products::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        $trash['products'] = $products;





        //increase model in $trash['model name']

        return view('backend.trash.index', compact('trash'));
    }



    public function restore($model, $modelId)

    {

        $this->authorize('restore trash');



        $this->getModel($model)::withTrashed()->find($modelId)->restore();



        return redirect('backend/trash');
    }



    public function restoreAll($model)

    {

        $this->authorize('restore_all trash');



        $this->getModel($model)::withTrashed()->restore();



        return redirect('backend/trash');
    }



    public function remove($model, $modelId)

    {

        $this->authorize('remove trash');


        // Products: Delete Stock and Product Tags
        if ($model == 'products') {
            $modelItem = $this->getModel($model)::withTrashed()->find($modelId);
            // Stocks
            $modelItem->stocks()->forceDelete();
            // Product Tags
            $modelItem->producttags()->forceDelete();
            // Promotion Details
            $modelItem->promotion_details()->forceDelete();

            $modelItem->forceDelete();
        } else {
            $this->getModel($model)::withTrashed()->find($modelId)->forceDelete();
        }

        return redirect('backend/trash');
    }



    public function removeAll($model)

    {

        $this->authorize('remove_all trash');

        /**

         * This command will not remove medias in mediacollection because mass assignment in document

         */

        // $this->getModel($model)::onlyTrashed()->forceDelete();



        $modelItems = $this->getModel($model)::onlyTrashed()->get();



        foreach ($modelItems as $modelItem) {
            // Stocks
            $modelItem->stocks()->forceDelete();
            // Product Tags
            $modelItem->producttags()->forceDelete();
            // Promotion Details
            $modelItem->promotion_details()->forceDelete();

            $modelItem->forceDelete();
        }



        return redirect('backend/trash');
    }



    private function getModel($model)

    {

        $class = '\App\Model\\' . ucfirst($model);

        if ($model == 'user') {

            $class = '\App\\' . ucfirst($model);
        }

        return get_class(new $class);
    }
}
