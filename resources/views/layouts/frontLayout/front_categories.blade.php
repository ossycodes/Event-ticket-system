<div class ="container" style="background:#f3f3f3;">

    <strong>Categories: </strong>
    <?php
        $noOfCategories = count($allCategories);
        //echo $noOfCategories; die;
    ?>

        @if($noOfCategories)	
        @foreach($allCategories as $category)
            <a href="{{ url('category/'.$category->id) }}" style="text-decoration:none;"><span class="label label-warning">{{ $category->name }}</span></a>
        @endforeach
        @else
        <strong>No category(ies) added by admin.</strong>
        @endif

</div>