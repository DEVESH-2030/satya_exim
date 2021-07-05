  @include("website.layout.header")
<style type="text/css">

   
</style>
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>Demo Page</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Demo Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div id="slider-range"></div>
    </div>
  </div>
  <div class="row slider-labels">
    <div class="col-6 caption">
      <strong>Min:</strong> <span id="slider-range-value1"></span>
    </div>
    <div class="col-6 text-right caption">
      <strong>Max:</strong> <span id="slider-range-value2"></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form>
        <input type="hidden" name="min-value" value="">
        <input type="hidden" name="max-value" value="">
      </form>
    </div>
  </div>
</div>





  @include("website.layout.footer")