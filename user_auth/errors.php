<?php

if (count($errors)>0): ?> 
        <div class="alert alert-danger">
           <?php   foreach($errors as $err): ?>
                <li><?=$err; ?></li>  
                <?php endforeach; ?>                
        </div>
                        
    <?php endif; ?>