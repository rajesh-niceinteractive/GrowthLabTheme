<?php
/**
 * Template Name: Test Template
 *
 * @package underscores
 */
get_header(); ?>
<div class="page_default general review_page  <?php if (has_post_thumbnail()) { ?>bnroverlay<?php } ?>" <?php if (has_post_thumbnail()) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);"<?php } ?>>
    <div class="container">
        <div class="page-content ">
            <div class="phonenumbershortcode">
                [phonenumber]<br/>
                Just provide an <a> tag with a link and text.
                <?php
                        $html = '<a href="https://example.com">Link Text</a>';
                        echo '<pre>' . htmlspecialchars($html) . '</pre>';
                        ?>
                <br/>
                <br/>
                [phonenumber id="buttonid"]<br/>
                Just provide an <a> tag with a link, text, and an id attribute.
                 <?php
                        $html = '<a href="https://example.com" id="id_name">Link Text</a>';
                        echo '<pre>' . htmlspecialchars($html) . '</pre>';
                        ?>
                <br/>
                <br/>
                [phonenumber class="button class"]<br/>
                Just provide an <a> tag with a link, text, and a class attribute.
                <?php
                        $html = '<a href="https://example.com" class="class_name">Link Text</a>';
                        echo '<pre>' . htmlspecialchars($html) . '</pre>';
                        ?>
                <br/>
                <br/>
                [phonenumber wraper="wrapper class"]<br/>
                Just provide a link tag with text, wrapped inside a <div> that contains the <a> tag.
                    <?php
                        $html = '<div class="wrapper"><a href="https://example.com">Link Text</a></div>';
                        echo '<pre>' . htmlspecialchars($html) . '</pre>';
                        ?>
                <br/><br/>
                [justnumber]
                -> This only returns a number, not any HTML content. It’s better to add it in the header file along with SVG icons.
                <br/>
                <?php
                        $html = '<a href="tel:xxx-xxx-xxxx" class="cart-link"><svg><!-- your SVG icon --></svg></a>';
                        echo '<pre>' . htmlspecialchars($html) . '</pre>';
                        ?>
                
            </div><br/><br/><br/><br/><br/>
            <h1>What is Lorem Ipsum?</h1>
            <h2>What is Lorem Ipsum?</h2>
            <h3>What is Lorem Ipsum?</h3>
            <h4>What is Lorem Ipsum?</h4>
            <h5>What is Lorem Ipsum?</h5>
            <h6>What is Lorem Ipsum?</h6>
            <p><strong>Lorem Ipsum</strong> is simply <b>dummy text of the</b> printing and <small>typesetting industry</small>. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown <a href="#">printer took a galley </a>of type and scrambled it to <i>make a type specimen book</i>. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the <u>1960s with the release of Letraset</u> sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
            <div>type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</div>
            <ul>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                <li>Lorem Ipsum is <a href="#">simply dummy</a> of the printing and typesetting industry.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    <ul>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                        <li>Lorem Ipsum is <a href="#">simply dummy</a> of the printing and typesetting industry.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                    </ul>
                </li>
            </ul>
            <ol>
                <li>Lorem Ipsum is <a href="#">simply dummy</a> text of the printing and typesetting industry.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    <ol>
                        <li>Lorem Ipsum is <a href="#">simply dummy</a> text of the printing and typesetting industry.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                    </ol>
                </li>
            </ol>
            <h1><a href="#">What is Lorem Ipsum?</a></h1>
            <h2><a href="#">What is Lorem Ipsum?</a></h2>
            <h3><a href="#">What is Lorem Ipsum?</a></h3>
            <h4><a href="#">What is Lorem Ipsum?</a></h4>
            <h5><a href="#">What is Lorem Ipsum?</a></h5>
            <h6><a href="#">What is Lorem Ipsum?</a></h6>

            <button type="button" class="btn">Submit button</button>
            <label>Text</label>
            <input type="text" placeholder="Lorem ipsum dolor" />
            <label>Tel</label>
            <input type="tel" placeholder="Lorem ipsum dolor" />
            <label>Email</label>
            <input type="email" placeholder="Lorem ipsum dolor" />
            <label>Date</label>
            <input type="date" placeholder="Lorem ipsum dolor" />
            <label>Password</label>
            <input type="password" placeholder="Lorem ipsum dolor" />
            <select>
                <option value="">1</option>    
                <option value="">2</option>    
                <option value="">3</option>    
                <option value="">4</option>    
                <option value="">5</option>    
                <optgroup label="Numbers">
                    <option value="">1</option>    
                    <option value="">2</option>    
                    <option value="">3</option>    
                    <option value="">4</option>    
                    <option value="">5</option> 
                </optgroup>
            </select>

            <input type="button" value="submit" />
            <input type="reset" value="reset" />

            <button type="button">button</button>
            <button type="Submit">Submit</button>
            <button type="reset">Reset</button>

            <a href="" class="btn">Button Normal</a>
            <a href="" class="btn but-1">Button Normal 1</a>
            <a href="" class="btn but-2">Button Normal 2</a>
            <a href="" class="btn but-3">Button Normal 3</a>
            <div class="btn-group">
                <a href="" class="btn">Button Normal</a>
                <a href="" class="btn but-1">Button Normal 1</a>
                <a href="" class="btn but-2">Button Normal 2</a>
                <a href="" class="btn but-3">Button Normal 3</a>
            </div>
            
        </div>
    </div>
</div>

<?php get_footer();