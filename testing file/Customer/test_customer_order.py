from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time

driver = webdriver.Chrome()

try:
    
    print("Authenticating session")
    driver.get("http://localhost/Bakery_Hub_new/common/View/login.php")
    driver.maximize_window()
    driver.find_element(By.ID, "email").send_keys("test@gmail.com")
    driver.find_element(By.ID, "password").send_keys("123456")
    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(1) # Wait for redirect
    
    
    print("Executing Feature 3: Order Placement Test")
    driver.get("http://localhost/Bakery_Hub_new/customer/view/customer_dashboard.php?page=order")
    time.sleep(2) 

    product_dropdown = Select(driver.find_element(By.NAME, "product_id"))
    product_dropdown.select_by_index(2) 
    
    quantity_input = driver.find_element(By.NAME, "quantity")
    quantity_input.send_keys("2")
    
    time.sleep(1)
    driver.find_element(By.NAME, "place_order").click()
    
    print("Order placed successfully.")
    time.sleep(2) 

except Exception as e:
    print(f"Script failed: {e}")
finally:
    driver.quit()