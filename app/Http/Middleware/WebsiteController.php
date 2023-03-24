<?php
namespace App\Http\Middleware;
use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $websites = Website::all();

        return response()->json([
            'status' => true,
            'message' => 'Websites fetched successfully.',
            'data' => [
                'websites' => $websites,
            ],
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:websites',
            'domain' => 'required|unique:websites'
        ]);

        $websiteName = $request->get('name');
        $domain = $request->get('domain');

        Website::create([
            'name' => $websiteName,
            'domain' => $domain
        ]);

        return response('Website created successfully');
    }

    public function delete(Request $request)
    {
        $id = $request ->get('id');
        $website = Website::where('id', $id)->first();
        if ($website) {
            $website->delete();
            return response()->json(['message' => 'Successfully Deleted']);
        } else {
            return response()->json(['message' => 'Website not found']);
        }
    }
}

