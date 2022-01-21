<x-layout>
    <div class="mx-5 md:mx-60">
        <style>
            p {
                margin: 1rem;
            }

            h1 {
                margin-top: 2rem;
                margin-bottom: 2rem;
                font-size: 25pt;
                font-weight: bold;
                text-align: center;
            }

            h2 {
                margin-top: 1rem;
                margin-bottom: 1rem;
                font-size: 16pt;
                font-weight: bold;
            }

            h3 {
                margin-top: 0.5rem;
                margin-bottom: 0.5rem;
                margin-left: 1rem;
                font-size: 12pt;
                font-weight: bold;
            }

            li {
                margin-left: 1rem;
            }

            a.help {
                color: rgb(192, 8, 8);
            }

            a:hover {
                text-decoration: underline;
            }

            blockquote {
                background: rgb(233, 233, 233);
                margin-left: 4rem;
                margin-right: 4rem;
                border-left: 2px solid rgb(61, 61, 61);
            }
        </style>

        <h1>Here's what's going on...</h1>

        <ul>
            <li><a class="help" href="#writing-notes">Writing Notes</a></li>
            <li><a class="help" href="#notelettes">Notelettes</a>
                <ul>
                    <li><a class="help" href="#edit-notelette-dialog-box">Edit Notelette Dialog Box</a></li>
                </ul>
            </li>
            <li><a class="help" href="#notebooks">Notebooks</a></li>
            <li><a class="help" href="#library-items">Library Items</a>
                <ul>
                    <li><a class="help" href="#quests">Quests</a></li>
                    <li><a class="help" href="#npcs">NPCs</a></li>
                    <li><a class="help" href="#locations">Locations</a></li>
                    <li><a class="help" href="#organizations">Organizations</a></li>
                    <li><a class="help" href="#inventory-items">Inventory Items</a></li>
                </ul>
            </li>
            <li><a class="help" href="#dd-beyond-integration">D&amp;D Beyond Integration</a>
                <ul>
                    <li><a class="help" href="#switching-the-inventory-toggle">Switching the Inventory Toggle</a></li>
                    <li><a class="help" href="#saving-your-dd-beyond-inventory">Saving Your D&amp;D Beyond Inventory</a></li>
                    <li><a class="help" href="#importing-your-dd-beyond-inventory">Importing Your D&amp;D Beyond Inventory</a></li>
                </ul>
            </li>
            <li><a class="help" href="#header-dismissal-and-zen-mode">Header Dismissal and Zen Mode</a></li>
        </ul>
        <h2 id="writing-notes">Writing Notes</h2>
        <p>Click the red circle plus button to start a new note. The title will automatically populate with the day, date, and time, but you can change it to whatever you want. A title is required to save properly, though. When you start a new note, you cannot create a <a class="help" href="#notelettes">notelette</a> until you press either the Save button or Ctrl+Enter. After you do that, you may continue the note and/or edit it by clicking within it and you may create a notelette within the note at any time.
        </p>
        <h2 id="notelettes">Notelettes</h2>
        <p>A Notelette is a small selection within a note that provides context for a previouly establihed idea. You can create a notelette by selecting text within a note, right clicking, and clicking on the <a class="help" href="#library-items">item</a> for which the notelette provides context. If that item doe not yet exist, you can create it by clicking on the heading that most closely describes it.</p>
        <p><strong>After you create a notelette, you will not be able to edit it by editing its containing note!</strong> This is to ensure you don't accidentally delete your notelette while editing your note. You <em>can</em> edit the notelette by clicking on it and manipulating the options in the dialog box that pops up.</p>
        <p>A list of a note's notelettes will be available at the end of the note as a drop-down section.</p>
        <h3 id="edit-notelette-dialog-box">Edit Notelette Dialog Box</h3>
        <p>When you click on a notelette, whether it's inside of its containing note, or listed under its associated <a class="help" href="#library-items">library item</a>, a dialog box will pop up providing options to change things about the notelette. These options include changing the text of the notelette, selecting other <a class="help" href="#library-items">library items</a> for which it may provide context, and/or deleting the notelette entirely.</p>
        <p>When a notelette is deleted, the text of the notelette will remain in the note, but will also become editable just like the rest of the note.</p>
        <h2 id="notebooks">Notebooks</h2>
        <p>You may find yourself needing to organize your notes according to separate campaigns, characters or any number of other criterea. In these situations it will be useful to create a new notebook. You may do so by clicking the light-red circle plus button in the top-lefthand corner of the interface next to the &quot;All&quot; button. A dialog will pop up where you can enter the name of a new notebook and click the &quot;Create&quot; button. If you already have other notebooks, they will show here with an option to be deleted.</p>
        <p>After you create a new notebook, you may specify that any note or <a href="#library-items" class="help">library item</a> should be put into it by selecting the notebook from the dropdown menu during the editing or creating process.</p>
        <p>When the notebook is selected, you will only see the information inside it.</p>
        <p>Also while the notebook is selected, you may click the notebook's name to change it, pressing Enter to save the new name.</p>
        <p>While a notebook is selected, when you search for anything, the search bar will only return results from that notebook.</p>
        <p>If you wish to see or search through all of the notes and library items you have made without being filtered by notebooks, you may click the &quot;All&quot; button.</p>
        <h2 id="library-items">Library Items</h2>
        <p>A library item is any item that you will need to refer back to during the course of your game. You can create a library item by clicking the blue square plus button. Currently, library items are divided into five categories: <em><a href="#quests" class="help">Quests</a></em>, <em><a href="#npcs" class="help">NPCs</a></em>, <em><a href="#locations" class="help">Locations</a></em>, <em><a href="#organizations" class="help">Organizations</a></em>, and a final, special category: <em><a href="#inventory-items" class="help">Inventory Items</a></em>. You can click on the heading for any one of these categories to see an index of all the items within that category and within the currently selected notebook. Clicking on the item's box will reveal a dialog box filled with all the recorded information about it, including a list of associated <a class="help" href="#notelettes">notelettes</a>. After creating a library item, you may edit it at any time by clicking &quot;Edit&quot; in this dialg box, even including changing its category, because this is a magical land where NPCs can magically turn into Inventory Items!</p>
        <h3 id="quests">Quests</h3>
        <p>A quest will require a title and a breif description of any kind. You may also define who sent you on the quest if that NPC exists in your library, or where you need to go for the quest if that location exists in your library. You may also define which notebook the item should be written in.</p>
        <h3 id="npcs">NPCs</h3>
        <p>An NPC will require a name and a breif description. You may also define where they live if such a location exists in your library, or what organization they are a member of if such an organization exists in your library. You may also define which notebook the item should be written in.</p>
        <h3 id="locations">Locations</h3>
        <p>A location only requires a name and a breif description. You may also define which notebook the item should be written in.</p>
        <h3 id="organizations">Organizations</h3>
        <p>An organization requires a name and a breif description. You may also define where the organization's headquarters resides if such a location exists in your library. You may also define which notebook the item should be written in.</p>
        <h3 id="inventory-items">Inventory Items</h3>
        <p>When creating a new Inventory Item, you must give it a name and a description. You may also define where the item is if such a location exists in your library, whether the item is part of a quest if such a quest exits in your library, or whether an NPC owns this item if such an NPC exists in your library.</p>
        <p>Inventory Item is a special category because it offers the unique function of importing your inventory from D&amp;D Beyond!</p>
        <h2 id="dd-beyond-integration">D&amp;D Beyond Integration</h2>
        <p>Please note that Catharicosa Notes has no direct affiliation with D&amp;D Beyond, Fandom, or Wizards of the Coast.</p>
        <h3 id="switching-the-inventory-toggle">Switching the Inventory Toggle</h3>
        <p>When you first register and log in to Catharicosa Notes, you will find a text field in the right sidebar with instructions to enter the number found in your D&amp;D Beyond character sheet's URL. Over that text field is a heading with a triangle next to it. Click that triangle and you will find a toggle with the D&amp;D Beyond logo on one side and the Catharicosa logo on the other.</p>
        <p>If the toggle is on D&amp;D Beyond you will see your D&amp;D Beyond inventory. If it is on Catharicosa, you will see only your local inventory. The primary difference between the two is that you cannot edit your D&amp;D Beyond inventory from Catharicosa. If you never wish to use your D&amp;D Beyond inventory, you may toggle over to Catharicosa, hide the toggle, and never see it again if you wish.</p>
        <h3 id="saving-your-dd-beyond-inventory">Saving Your D&amp;D Beyond Inventory</h3>
        <p>When you navigate to your online D&amp;D Beyond character sheet, the URL in your browser's address bar should look something like this:</p>
        <blockquote class="overflow-scroll font-mono">
            <p>https://www.dndbeyond.com/profile/LordSteve/characters/<strong>14644141</strong></p>
        </blockquote>
        <p>You'll want to copy the bold part and paste it into the text field. When you do this, Catharicosa Notes should automatically load your D&amp;D Beyond inventory. If it doesn't, make sure you have the correct number and that your D&amp;D Beyond character profile is set to Public (this will be the very last toggle on the very first page of the character builder).</p>
        <p>When your D&amp;D Beyond inventory is loaded, you can click &quot;Save&quot; so that it will be re-loaded whenever you load the page and/or toggle over to D&amp;D Beyond in the future.</p>
        <h3 id="importing-your-dd-beyond-inventory">Importing your D&amp;D Beyond Inventory</h3>
        <p>While your D&amp;D Beyond inventory is loaded, you may click Import and all the items you have in your D&amp;D Beyond inventory will be transferred into your local library of items. There are a few things to note about this process:</p>
        <ul class="list-disc list-inside">
            <li>Your items will now be editable! However, they will remain unchanged on D&amp;D Beyond.</li>
            <li>If you gain a new item in D&amp;D Beyond, it will not automatically be transferred to your local library.</li>
            <li>If you import your inventory again in the future without first deleting the original items, you will end up with duplicates.</li>
            <li>Instead of re-importing, it may be easier to simply copy/paste any new D&amp;D Beyond item information into a new Catharicosa item.</li>
        </ul>
        <h2 id="header-dismissal-and-zen-mode">Header Dismissal and Zen Mode</h2>
        <p>Scrolling the interface all the way down to the bottom will bring the header out of view (dimissed) so you can just focus on taking notes and referencing the library. You can also click on the Library (<img src="images/scrollicon.png" class="inline h-4" />) icon and the Inventory (<img src="images/backpack.png" class="inline h-4" />) icon to make their respective sidebars collapse. With the sidebars collapsed and the header dismissed, you can just focus on writing. We call this Zen Mode. Some players may prefer to write their notes in Zen Mode during the game and then come back later after the game to find and create notelettes and library items.</p>
        <h2 class="text-center">Thank you for using Catharicosa Notes!</h2>
    </div>
    <div class="h-60 bg-gray-700 border-t-gray-900 flex flex-col justify-center">
        <div class="text-white text-center">
            <img src="/images/asterisk.png" class="inline w-10 h-10" />
            <p>A product of <a href="https://thegreenasterisk.com" class="text-white">The Green Asterisk</a></p>
        </div>
    </div>
</x-layout>
