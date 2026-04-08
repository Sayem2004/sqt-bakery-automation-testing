from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time
import random

driver = webdriver.Chrome()

try:
    print("Executing Feature 1: Registration Test")
    driver.get("http://localhost/Bakery_Hub_new/common/View/register.php") 
    driver.maximize_window()
    time.sleep(2)

    
    random_email = f"testuser_{random.randint(1000, 9999)}@test.com"

    driver.find_element(By.ID, "name").send_keys("Sayem")
    driver.find_element(By.ID, "phone").send_keys("01700000000")
    driver.find_element(By.ID, "email").send_keys(random_email)
    driver.find_element(By.ID, "password").send_keys("123456")

    role_dropdown = Select(driver.find_element(By.ID, "role"))
    role_dropdown.select_by_value("customer")
    
    time.sleep(1)
    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    
    print(f"Registration submitted successfully for: {random_email}")
    time.sleep(2)

except Exception as e:
    print(f"Script failed: {e}")
finally:
    driver.quit()